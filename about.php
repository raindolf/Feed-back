<?php 
	session_start();
	require_once(dirname(__FILE__)."/customer/simpleusers/su.inc.php");

	$customer = new SimpleUsers();
	
	$admin = $customer->getInfo('Admin');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>About |  Cola Buster Limited</title>
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
              <li class="current"><a href="about.php">About</a></li>
              <li><a href="feedback.php">Feedback</a></li>              
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
              <?php if($admin): ?>
              <li><a href="admin/data/index.php">Admin</a></li>
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
	<div class="container_12">
      <div class="grid_8">
          <div class="pad-1">
              <h2 class="h2">About us </h2>
              <div class="wrap">
              	<img src="images/page2-img1.jpg" alt="" class="img-indent-2 img-radius">
                <div class="extra-wrap">
                	<p class="color-1 p2">Cola Buster Limited,  a fictive company herein deemed to have been established in 1990, has branches  all over Ghana. </p>
                    <p>This owned by Mr.  John Smith is located in Accra. Among others, Cola&nbsp;Buster Company  specializes in the production </p>
                </div>
              </div>
              <p>of chocolate, toffees, drinks and its  subsidiaries for a variety of age groups i.e. ranging between children, adults  to the very aged.&nbsp;&nbsp;For some time now, Cola Buster limited has been  facing crucial marketing related problems such as effective capturing of what  the customers think of their products.</p>
              <?php echo "Hehehehehhe ..." . $customer->logged_in; ?>
          </div>
      </div>
      <div class="grid_4">
          <div class="pad-1">
          	<h2 class="h2">Our history</h2>
            <div class="wrap block-4 p2">
            	<p class="color-3">1990</p>
                <p class="extra-wrap">Year in which we were founded. </p>
            </div>
            <div class="wrap block-4 p2">
            	<p class="color-3">2000</p>
                <p class="extra-wrap">Opened 4 offices in different parts of Ghana. </p>
            </div>
            <div class="wrap block-4">
            	<p class="color-3">2012</p>
                <p class="extra-wrap">Started exporting our products to other west African countries. </p>
            </div>
          </div>
      </div> 
      <div class="grid_12"></div>       
      <div class="clear"></div>
    </div>
</section> 
<!--==============================footer=================================-->
  <footer>
      <p>© 2014 Cola Buster Limited</p>
     
  </footer>	
<script>
	Cufon.now();
</script>
</body>
</html>