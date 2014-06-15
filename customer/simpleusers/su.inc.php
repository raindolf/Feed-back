<?php



	$path = dirname(__FILE__);

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


function getCons() {
   /*
 global $dbHost, $user_name, $password, $dbName;
    $con = mysql_connect($dbHost, $user_name, $password);
    @mysql_select_db($dbName) or die("Unable to select database");
    return $con;
*/
    
     $mysqli = new mysqli($GLOBALS["mysql_hostname"], $GLOBALS["mysql_username"], $GLOBALS["mysql_password"], $GLOBALS["mysql_database"]); 

/* check connection */

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}else{
	return $mysqli;
}

}

function closeCons($con) {
/*     mysql_close($con); */
$con->close();
}
	include_once($path."/users.obj.php");

?>