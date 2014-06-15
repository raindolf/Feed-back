<?php

	/**
	* Make sure you started your'e sessions!
	* You need to include su.inc.php to make SimpleUsers Work
	* After that, create an instance of SimpleUsers and your'e all set!
	*/

	session_start();
	require_once(dirname(__FILE__)."/simpleusers/su.inc.php");

	$customer = new SimpleUsers();

		$admin = $customer->getInfo('Admin');
		
	if(!$customer->logged_in){
				header("Location: login.php");
				exit;
		}
		
		$mysqli = new mysqli($GLOBALS["mysql_hostname"], $GLOBALS["mysql_username"], $GLOBALS["mysql_password"], $GLOBALS["mysql_database"]); 
		$feedbacks = array();

/* check connection */

	

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Feedback</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/grid_12.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css" />
    <script src="../js/jquery-1.7.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/cufon-yui.js"></script>
    <script src="../js/Vegur-L_300.font.js"></script>
    <script src="../js/Vegur-M_500.font.js"></script>
    <script src="../js/Vegur-R_400.font.js"></script>
    <script src="../js/cufon-replace.js"></script>
    <script src="../js/FF-cash.js"></script>
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
      <h1><a href="../index.php"><img src="../images/logo.png" alt=""></a></h1>
      <nav>
          <ul class="menu">
              <li><a href="../index.php">Home</a></li>
              <li><a href="../about.php">About</a></li>
              <li><a href="../feedback.php">Feedback</a></li>
              
              <li><a href="../contacts.php">Contacts</a></li>

              <li class="current"><a href="portal.php">Customer Portal</a></li>
              <?php if($admin): ?>
              <li><a href="../admin/data/index.php">Admin</a></li>
              <?php endif; ?>
              <li><a href="logout.php">Logout</a></li>

              
          </ul>    
      </nav>
    </div> 
</header>   
<section id="header-content"></section>
<!--==============================content================================-->
<br>



<div align="center" > <h2 class="style1" > Welcome to the customer portal </h2> 
</div>

<div id="page-wrap">
		<div id="portal-area">
		

<?php 

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}else{
$query = "SELECT id,product, branch, employee, feedback,suggestion FROM feedback WHERE customerId='".$_SESSION["SimpleUsers"]["customerId"]."'";
 if ($result = $mysqli->query($query)) {
echo "<table>";
while($row = mysqli_fetch_array($result)){
echo "<tr><td>" .$row['id'] . "</td><td>".
"<td>" .$row['product'] . "</td><td>". 
"<td>" .$row['branch'] . "</td><td>".
"<td>" .$row['employee'] . "<a href='../edit_feedback.php?id=" . $row['id']. "'>Edit</a></td></tr>";
}
echo "</table>";

    /* free result set */
    $mysqli->close();

}else{
  if ($mysqli->error) {
    try {    
        throw new Exception("MySQL error " .$mysqli->error ." <br> Query:<br> " .$query .",". $msqli->errno);    
    } catch(Exception $e ) {
        echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
        echo nl2br($e->getTraceAsString());
    }
}

}
}

?>



<div style="clear: both;"></div>

</div>




<section id="content" class="border subpage-content"><div class="ic">
  <div align="center"></div>
</div>
</section> 
<div align="center">
  <!--==============================footer=================================-->
</div>
<footer>
      <p align="center">© 2014 Cola Buster Limited</p>
      
  </footer>	
<div align="center">
  <script>
	Cufon.now();
</script>
</div>
</body>
</html>