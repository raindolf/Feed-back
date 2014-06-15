<?php 
	session_start();
	require_once(dirname(__FILE__)."/customer/simpleusers/su.inc.php");

	$customer = new SimpleUsers();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thank you for sending us your feed back</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/cufon-yui.js"></script>
    <script src="js/Vegur-L_300.font.js"></script>
    <script src="js/Vegur-M_500.font.js"></script>
    <script src="js/Vegur-R_400.font.js"></script>
    <script src="js/cufon-replace.js"></script>
    <script src="js/FF-cash.js"></script>
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
</head>
<body>
<!--==============================header=================================-->
<header>
  	<div class="main">
      <h1><a href="index.php"><img src="images/logo.png" alt=""></a></h1>
      <nav>
          <ul class="menu">
              <li><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li class="current"><a href="feedback.php">Feedback</a></li>              
              <li><a href="contacts.php">Contacts</a></li>
              <?php if(!$customer->logged_in): ?>
              <li><a href="customer/login.php">Login</a></li>
              <?php endif; ?>
              <?php if(!$customer->logged_in): ?>
              <li><a href="customer/register.php">Sign Up</a></li>
              <?php endif; ?>
              <?php if($customer->logged_in): ?>
              <li><a href="customer/portal.php">Customer Portal</a></li>
              <?php endif; ?>
              <?php if($customer->logged_in): ?>
              <li><a href="customer/logout.php">Logout</a></li>
              <?php endif; ?>
          </ul>    
      </nav>
    </div> 
</header>   
<section id="header-content"></section>
<!--==============================content================================-->
<section id="content" class="border subpage-content"><div class="ic"></div>
  <div align="center"><img src="images/feedback.jpg" alt="feed back" width="610" height="350"></div>
</section> 
<!--==============================footer=================================-->
  <footer>
        <h4> <a href="index.php"> Go Back to Home </a></h4>
     
  </footer>	
<script>
	Cufon.now();
</script>
</body>
</html>