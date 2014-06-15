<?php

/* 	require_once('../preheader.php'); // <-- this include file MUST go first before any HTML/output */

	/* you SHOULD edit the database details below; fill in your database info */

	#this is the info for your database connection
    ####################################################################################
    ##
    
/*     include_once($_SERVER['DOCUMENT_ROOT']."/cola/config.php"); */


/* 	include_once($_SERVER['DOCUMENT_ROOT']."/cola/config.php"); */
$user_name = "finaladmin";
$dbName = "final";
$password = "";
$dbHost = "localhost";
$con;




//Global variables for DB

	$GLOBALS["mysql_hostname"] = $dbHost;
	$GLOBALS["mysql_username"] = $user_name;
	$GLOBALS["mysql_password"] = $password;
	$GLOBALS["mysql_database"] = $dbName;
	
	$MYSQL_HOST = $dbHost;
	$MYSQL_LOGIN = $user_name;
	$MYSQL_PASS = $password;
	$MYSQL_DB = $dbName;



    
/*
	$MYSQL_HOST = "localhost";
	$MYSQL_LOGIN = "root";
	$MYSQL_PASS = "";
	$MYSQL_DB = "ajaxcrud_demos";
*/
    ##
    ####################################################################################

	/********* THERE SHOULD BE NO NEED TO EDIT BELOW THIS LINE *******/

	####################################################################################

	#a session variable is set by class for much of the CRUD functionality -- eg adding a row
    session_start();

    #for pesky IIS configurations without silly notifications turned off
    error_reporting(E_ALL - E_NOTICE);

	$db = @mysql_connect($MYSQL_HOST,$MYSQL_LOGIN,$MYSQL_PASS);

	if(!$db){
		echo('Unable to authenticate user. <br />Error: <b>' . mysql_error() . "</b>");
		exit;
	}
	$connect = @mysql_select_db($MYSQL_DB);
	if (!$connect){
		echo('Unable to connect to db <br />Error: <b>' . mysql_error() . "</b>");
		exit;
	}
	mysql_query("SET NAMES 'utf8'");

	# what follows are custom database handling functions - required for the ajaxCRUD class
	# ...but these also may be helpful in your application(s) :-)
	if (!function_exists('q')) {
		function q($q, $debug = 0){
			$r = mysql_query($q);
			if(mysql_error()){
				echo mysql_error();
				echo "$q<br>";
			}

			if($debug == 1)
				echo "<br>$q<br>";

			if(stristr(substr($q,0,8),"delete") ||	stristr(substr($q,0,8),"insert") || stristr(substr($q,0,8),"update")){
				if(mysql_affected_rows() > 0)
					return true;
				else
					return false;
			}
			if(mysql_num_rows($r) > 1){
				while($row = mysql_fetch_array($r)){
					$results[] = $row;
				}
			}
			else if(mysql_num_rows($r) == 1){
				$results = array();
				$results[] = mysql_fetch_array($r);
			}

			else
				$results = array();
			return $results;
		}
	}

	if (!function_exists('q1')) {
		function q1($q, $debug = 0){
			$r = mysql_query($q);
			if(mysql_error()){
				echo mysql_error();
				echo "<br>$q<br>";
			}

			if($debug == 1)
				echo "<br>$q<br>";
			$row = @mysql_fetch_array($r);

			if(count($row) == 2)
				return $row[0];
			else
				return $row;
		}
	}

	if (!function_exists('qr')) {
		function qr($q, $debug = 0){
			$r = mysql_query($q);
			if(mysql_error()){
				echo mysql_error();
				echo "<br>$q<br>";
			}

			if($debug == 1)
				echo "<br>$q<br>";

			if(stristr(substr($q,0,8),"delete") ||	stristr(substr($q,0,8),"insert") || stristr(substr($q,0,8),"update")){
				if(mysql_affected_rows() > 0)
					return true;
				else
					return false;
			}

			$results = array();
			$results[] = mysql_fetch_array($r);
			$results = $results[0];

			return $results;
		}
	}
	
	
	include ('../ajaxCRUD.class.php'); // <-- this include file MUST go first before any HTML/output
	
	session_start();
	//require_once($_SERVER['DOCUMENT_ROOT']."/cola/customer/simpleusers/su.inc.php");


class SimpleUsers
	{

		private $mysqli, $stmt;
		private $sessionName = "SimpleUsers";
		public $logged_in = false;
		public $is_admin = false;
		public $customerdata;

		/**
		* Object construct verifies that a session has been started and that a MySQL connection can be established.
		* It takes no parameters.
		*
		* @exception	Exception	If a session id can't be returned.
		*/

		public function __construct()
		{
			$sessionId = session_id();
			if( strlen($sessionId) == 0)
				throw new Exception("No session has been started.\n<br />Please add `session_start();` initially in your file before any output.");

			$this->mysqli = new mysqli($GLOBALS["mysql_hostname"], $GLOBALS["mysql_username"], $GLOBALS["mysql_password"], $GLOBALS["mysql_database"]);
			if( $this->mysqli->connect_error )
				throw new Exception("MySQL connection could not be established: ".$this->mysqli->connect_error);

			$this->_validateUser();
			$this->_populateUserdata();
			$this->_updateActivity();
		}

		/**
		* Returns a (int)user id, if the user was created succesfully.
		* If not, it returns (bool)false.
		*
		* @param	username	The desired username
		*	@param	password	The desired password
		*	@return	The user id or (bool)false (if the user already exists)
		*/

		public function createUser($name, $email,$mobile, $username, $password )
		{
			$salt = $this->_generateSalt();
			$password = $salt.$password;

			$sql = "INSERT INTO customers VALUES (NULL, ?,?,?,?, SHA1(?), ?, NOW(), NOW())";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("ssssss", $name, $email,$mobile, $username, $password, $salt);
			if( $this->stmt->execute() ){
			  $customer_id = $this->stmt->insert_id;
  				  //set user info
  				  $this->setInfo( 'Admin', 0, $customer_id);
  				  		  //login user
  				  $this->loginUser( $username, $password);
				return $customer_id;
			}
			return false;
		}

		/**
		* Pairs up username and password as registrered in the database.
		* If the username and password is correct, it will return (int)user id of
		* the user which credentials has been passed and set the session, for
		*	use by the user validating.
		*
		* @param	username	The username
		* @param	password	The password
		* @return	The (int)user id or (bool)false
		*/

		public function loginUser( $username, $password )
		{
			$sql = "SELECT customerId FROM customers WHERE uUsername=? AND SHA1(CONCAT(uSalt, ?))=uPassword LIMIT 1";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("ss", $username, $password);
			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 0)
				return false;

			$this->stmt->bind_result($customerId);
			$this->stmt->fetch();
		
			$_SESSION[$this->sessionName]["customerId"] = $customerId;
			$this->logged_in = true;
			

			return $customerId;
		}

		/**
		* Sets an information pair, consisting of a key name and that keys value.
		* The information can be retrieved with this objects getInfo() method.
		*
		* @param	key	The name of the key
		* @param	value	The keys value
		* @param	userId	Can be used if administrative control is needed
		* @return	This returns (bool)true or false.
		*/

		public function setInfo( $key, $value, $customerId = null)
		{
			if($customerId == null)
			{
				if( !$this->logged_in )
					return false;
			}

				$reservedKeys = array("customerId", "uUsername", "uActivity", "uCreated", "uLevel");
				if( in_array($key, $reservedKeys) )
					throw new Exception("customer information key \"".$key."\" is reserved for internal use!");

			if( $customerId == null )
				$customerId = $_SESSION[$this->sessionName]["customerId"];

			if( $this->getInfo($key, $customerId) )
			{
				$sql = "UPDATE customers_information SET infoValue=? WHERE infoKey=? AND customerId=? LIMIT 1";
				if( !$this->stmt = $this->mysqli->prepare($sql) )
					throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

				$this->stmt->bind_param("ssi", $value, $key, $customerId);
				$this->stmt->execute();
			}
			else
			{
				$sql = "INSERT INTO customers_information VALUES (?, ?, ?)";
				if( !$this->stmt = $this->mysqli->prepare($sql) )
					throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

				$this->stmt->bind_param("iss", $customerId, $key, $value);
				$this->stmt->execute();
			}

			return true;
		}

		/**
		* Use this function to retrieve user information attached to a certain user
		* that has been set by using this objects setInfo() method.
		*
		* @param	key	The name of the key you wan't the value from
		*	@param	userId	Can be used if administrative control is needed
		* @return	String with a given keys value or (bool) false if the user isn't logged in.
		*/

		public function getInfo( $key, $customerId = null )
		{

			if( $customerId == null )
			{
				if( !$this->logged_in )
					return false;

				$customerId = $_SESSION[$this->sessionName]["customerId"];
			}

			$sql = "SELECT infoValue FROM customers_information WHERE customerId=? AND infoKey=? LIMIT 1";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("is", $customerId, $key);
			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 0)
				return "";

			$this->stmt->bind_result($value);
			$this->stmt->fetch();

			return $value;

		}
		
		/**
		* Use this function to permanently remove information attached to a certain user
		* that has been set by using this objects setInfo() method.
		*
		* @param	key	The name of the key you wan't the value from
		*	@param	userId	Can be used if administrative control is needed
		* @return	(bool) true on success or (bool) false if the user isn't logged in.
		*/

		public function removeInfo( $key, $customerId = null )
		{

			if( $customerId == null )
			{
				if( !$this->logged_in )
					return false;

				$customerId = $_SESSION[$this->sessionName]["customerId"];
			}

			$sql = "DELETE FROM customers_information WHERE customerId=? AND infoKey=? LIMIT 1";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("is", $customerId, $key);
			$this->stmt->execute();

			if( $this->stmt->affected_rows > 0)
				return true;

			return false;
		}				


		/**
		* Use this function to retrieve all user information attached to a certain user
		* that has been set by using this objects setInfo() method into an array.
		*
		*	@param	userId	Can be used if administrative control is needed
		* @return	An associative array with all stored information
		*/

		public function getInfoArray( $customerId = null )
		{
			if( $customerId == null )
				$customerId = $_SESSION[$this->sessionName]["customerId"];

			$sql = "SELECT infoKey, infoValue FROM customers_information WHERE customerId=? ORDER BY infoKey ASC";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("i", $customerId);
			$this->stmt->execute();
			$this->stmt->store_result();

			$customerInfo = array();
			if( $this->stmt->num_rows > 0)
			{
				$this->stmt->bind_result($key, $value);
				while( $this->stmt->fetch() )
					$customerInfo[$key] = $value;
			}
			
			$customer = $this->getSingleUser($customerId);
			$customerInfo = array_merge($customerInfo, $customer);
			asort($customerInfo);

			return $customerInfo;
		}

		/**
		* Logout the active user, unsetting the userId session.
		* This is a void function
		*/

		public function logoutUser()
		{
			if( isset($_SESSION[$this->sessionName]) )
				unset($_SESSION[$this->sessionName]);

			$this->logged_in = false;
		}

		/**
		* Update the users password with this function.
		* Generates a new salt and a sets the users password with the given parameter
		*
		* @param	password	The new password
		* @param	userId	Can be used if administrative control is needed
		*/

		public function setPassword( $password, $customerId = null )
		{

			if( $customerId == null )
				$customerId = $_SESSION[$this->sessionName]["customerId"];

			$salt = $this->_generateSalt();
			$password = $salt.$password;

			$sql = "UPDATE customers SET uPassword=SHA1(?), uSalt=? WHERE customerId=? LIMIT 1";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("ssi", $password, $salt, $customerId);
			return $this->stmt->execute();
		}

		/**
		* Returns an array with each user in the database.
		*
		* @return	An array with user information
		*/

		public function getUsers()
		{
			
			$sql = "SELECT DISTINCT customerId, uUsername, uActivity, uCreated FROM customers ORDER BY uUsername ASC";

			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 0)
				return array();

			$this->stmt->bind_result($customerId, $username, $activity, $created);

			$customers = array();

			$i = 0;
			while( $this->stmt->fetch() )
			{		
				$customers[$i]["customerId"] = $customerId;
				$customers[$i]["uUsername"] = $username;
				$customers[$i]["uActivity"] = $activity;
				$customers[$i]["uCreated"] = $created;

				$i++;
			}

			return $customers;

		}

		/**
		* Gets the basic info for a single user based on the userId
		*
		* @param	userId	The users id
		* @return	An array with the result or (bool)false.
		*/

		public function getSingleUser( $customerId = null )
		{

			if( $customerId == null )
				$customerId = $_SESSION[$this->sessionName]["customerId"];

			$sql = "SELECT customerId, uName, uEmail,uMobile, uUsername, uActivity, uCreated FROM customers WHERE customerId=? LIMIT 1";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("i", $customerId);
			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 0)
				return false;

			$this->stmt->bind_result($customerId,$name, $email,$mobile, $username, $activity, $created);
			$this->stmt->fetch();

			$customer["customerId"] = $customerId;
			$customer["Name"] = $name;
			$customer["Email"] = $email;
			$customer["Mobile"] = $mobile;
			$customer["Username"] = $username;
			$customer["Activity"] = $activity;
			$customer["Created"] = $created;

			return $customer;

		}

		/**
		* Deletes all information regarding a user.
		* This is a void function.
		*
		* @param	userId	The userId of the user you wan't to delete
		*/

		public function deleteUser( $customerId )
		{
			$sql = "DELETE FROM customers WHERE customerId=?";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("i", $customerId);
			$this->stmt->execute();

			$sql = "DELETE FROM customers_information WHERE customerId=?";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("i", $customerId);
			$this->stmt->execute();

			return;
		}

		/**
		* Returns a hidden input field with a unique token value
		* for CSRF to be used with post data.
		* The token is saved in a session for later validation.
		* 
		* @param	xhtml	set to (bool) true for xhtml output
		* @return Returns a string with a HTML element and attributes
		*/
		
		public function getToken( $xhtml = true )
		{
			$token = $this->_generateSalt();
			$name = "token_".md5($token);
			
			$_SESSION[$this->sessionName]["csrf_name"] = $name;
			$_SESSION[$this->sessionName]["csrf_token"] = $token;
			
			$string = "<input type=\"hidden\" name=\"".$name."\" value=\"".$token."\"";
			if($xhtml)
				$string .= " />";
			else
				$string .= ">";
			
			return $string;
		}		
		
		/**
		* Use this method when you wish to validate the CSRF token from your post data.
		* The method returns true upon validation, otherwise false. 
		*
		* @return bool true or false
		*/
		
		public function validateToken()
		{
			$name = $_SESSION[$this->sessionName]["csrf_name"];
			$token = $_SESSION[$this->sessionName]["csrf_token"];
			unset($_SESSION[$this->sessionName]["csrf_token"]);
			unset($_SESSION[$this->sessionName]["csrf_name"]);
			
			if($_POST[$name] == $token)
				return true;
				
			return false;
		}		

		public function getProducts()
		{


           $sql = "SELECT name FROM products ORDER BY name ASC";

			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 0)
				return array();

			$this->stmt->bind_result($name);

			$products = array();

			$i = 0;
			while( $this->stmt->fetch() )
			{		
				$products[$i]["name"] = $name;
				

				$i++;
			}

			return $products;
			
			
			
		}
		
			public function getEmployees()
		{

			$sql = "SELECT fullname FROM employees ORDER BY fullname ASC";

			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 0)
				return array();

			$this->stmt->bind_result($fullname);

			$employees = array();

			$i = 0;
			while( $this->stmt->fetch() )
			{		
				$employees[$i]["fullname"] = $fullname;
				

				$i++;
			}

			return $employees;
			
			
		}
		
			public function getBranches()
		{

			$sql = "SELECT name FROM branches ORDER BY name ASC";

			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 0)
				return array();

			$this->stmt->bind_result($name);

			$branches = array();

			$i = 0;
			while( $this->stmt->fetch() )
			{		
				$branches[$i]["name"] = $name;
				

				$i++;
			}

			return $branches;
			
			
		}
		
		/**
		* This function updates the users last activity time
		* This is a void function.
		*/

		private function _updateActivity()
		{
			if( !$this->logged_in )
				return;

			$customerId = $_SESSION[$this->sessionName]["customerId"];

			$sql = "UPDATE customers SET uActivity=NOW() WHERE customerId=? LIMIT 1";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("i", $customerId);
			$this->stmt->execute();
			return;
		}

		/**
		* Validates if the user is logged in or not.
		* This is a void function.
		*/

		private function _validateUser()
		{
			if( !isset($_SESSION[$this->sessionName]["customerId"]) )
				return;

			if( !$this->_validateUserId() )
				return;

			$this->logged_in = true;
		}

		/**
		* Validates if the user id, in the session is still valid.
		*
		* @return	Returns (bool)true or false
		*/

		private function _validateUserId()
		{
			$customerId = $_SESSION[$this->sessionName]["customerId"];

			$sql = "SELECT customerId FROM customers WHERE customerId=? LIMIT 1";
			if( !$this->stmt = $this->mysqli->prepare($sql) )
				throw new Exception("MySQL Prepare statement failed: ".$this->mysqli->error);

			$this->stmt->bind_param("i", $customerId);
			$this->stmt->execute();
			$this->stmt->store_result();

			if( $this->stmt->num_rows == 1)
				return true;

			$this->logoutUser();

			return false;
		}
		
		/**
		* Populates the current users data information for 
		* quick access as an object.
		*
		* @return void
		*/	
		
		private function _populateUserdata()
		{
			$this->customerdata = array();
			
			if( $this->logged_in )
			{
				$customerId = $_SESSION[$this->sessionName]["customerId"];
				$data = $this->getInfoArray();
				foreach($data as $key => $value)
					$this->customerdata[$key] = $value;

			}
		}

		/**
		* Generates a 128 len string used as a random salt for
		* securing you oneway encrypted password
		*
		* @return String with 128 characters
		*/

		private function _generateSalt()
		{
			$salt = null;

			while( strlen($salt) < 128 )
				$salt = $salt.uniqid(null, true);

			return substr($salt, 0, 128);
		}


	}

	$SimpleUsers = new SimpleUsers();

	
	if(!$SimpleUsers->logged_in){
				header("Location: login.php");
				exit;
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Feedback</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/grid_12.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css" />
    <script src="../../js/jquery-1.7.min.js"></script>
    <script src="../../js/jquery.easing.1.3.js"></script>
    <script src="../../js/cufon-yui.js"></script>
    <script src="../../js/Vegur-L_300.font.js"></script>
    <script src="../../js/Vegur-M_500.font.js"></script>
    <script src="../../js/Vegur-R_400.font.js"></script>
    <script src="../../js/cufon-replace.js"></script>
    <script src="../../js/FF-cash.js"></script>
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
    	<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
	<![endif]-->
    <style type="text/css">
<!--
.style1 {color: #000000}
-->
    </style>
	</head>
	<body>
	<!--==============================header=================================-->
<header>
  	<div class="main">
      <h1><a href="../../index.php"><img src="../../images/logo.png" alt=""></a></h1>
      <nav>
          <ul class="menu">
              <li><a href="../../index.php">Home</a></li>
              <li><a href="../../about.php">About</a></li>
              <li><a href="../../feedback.php">Feedback</a></li>
              
              <li><a href="../../contacts.php">Contacts</a></li>

              <li><a href="../../customer/portal.php">Customer Portal</a></li>
              <li class="current"><a href="index.php">Admin</a></li>
              <li><a href="../../customer/logout.php">Logout</a></li>

              
          </ul>    
      </nav>
    </div> 
</header>
<div class="admin_panel">  

	<h5> Manage Employees </h5>
<?
    $tblDemo = new ajaxCRUD("Employees", "employees", "id", "../");
    $tblDemo->omitPrimaryKey();
    $tblDemo->displayAs("fullname", "FullName");
    $tblDemo->displayAs("position", "Position");
    
/*


    $allowableValues = array("Allowable Value 1", "Allowable Value2", "Dropdown Value", "CRUD");
    $tblDemo->defineAllowableValues("fldCertainFields", $allowableValues);
*/

    //set field fldCheckbox to be a checkbox
/*     $tblDemo->defineCheckbox("fldCheckbox", "1", "0"); */

    $tblDemo->setLimit(5);
    $tblDemo->addAjaxFilterBox('fullname');
/*
	$tblDemo->formatFieldWithFunction('fullname', 'makeBlue');
	$tblDemo->formatFieldWithFunction('position', 'makeBold');
*/
	$tblDemo->showTable();

	echo "<br /><hr ><br />\n";
	
	echo "<h5> Manage Products </h5>\n";

    $tblDemo2 = new ajaxCRUD("Products", "products", "id");
    $tblDemo2->omitPrimaryKey();
    $tblDemo2->displayAs("name", "Name");
    $tblDemo2->displayAs("description", "Description");



    $tblDemo2->setLimit(20);
    $tblDemo2->addAjaxFilterBox('name');
	$tblDemo2->formatFieldWithFunction('name', 'makeBlue');
	$tblDemo2->formatFieldWithFunction('description', 'makeBold');
	$tblDemo2->showTable();


	function makeBold($val){
		return "<b>$val</b>";
	}

	function makeBlue($val){
		return "$val";
	}
	
	


	echo "<br /><hr ><br />\n";
	echo "<h5> Manage Branches </h5>\n";

    $tblBranches = new ajaxCRUD("Branches", "branches", "id");
    $tblBranches->omitPrimaryKey();
    $tblBranches->displayAs("name", "Name");
    $tblBranches->displayAs("location", "Location");



    $tblBranches->setLimit(20);
    $tblBranches->addAjaxFilterBox('name');
	$tblBranches->formatFieldWithFunction('name', 'makeBlue');
	$tblBranches->formatFieldWithFunction('location', 'makeBold');
	$tblBranches->showTable();



	
	
	echo "<br /><hr ><br />\n";
	
	echo "<h5> Manage Feedbacks </h5>\n";

   $tblFeedback = new ajaxCRUD("Feedback", "feedback", "id");
   $tblFeedback->omitPrimaryKey();
   $tblFeedback->displayAs("customerId", "Customer ID");
   $tblFeedback->displayAs("fname", "First Name");
   $tblFeedback->displayAs("lname", "Last Name");
   $tblFeedback->displayAs("email", "Email");
   $tblFeedback->displayAs("mobile_number", "Mobile Number");
   $tblFeedback->displayAs("product", "Product");
   $tblFeedback->displayAs("branch", "Branch");
   $tblFeedback->displayAs("employee", "Employee");
   $tblFeedback->displayAs("feedback", "FeedBack");
   $tblFeedback->displayAs("suggestion", "Suggestion");
   
   $tblFeedback->setTextareaHeight('feedback', 100);
   $tblFeedback->setTextareaHeight('suggestion', 100);




   $tblFeedback->setLimit(20);
   $tblFeedback->addAjaxFilterBox('fname');
   $tblFeedback->formatFieldWithFunction('fname', 'makeBlue');
   $tblFeedback->formatFieldWithFunction('employee', 'makeBold');
   $tblFeedback->disallowAdd();
   $tblFeedback->showTable();


?>
</div>
	</body>
</html>
