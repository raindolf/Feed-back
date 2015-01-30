<?php 
	session_start();
	require_once(dirname(__FILE__)."/customer/simpleusers/su.inc.php");

	$customer = new SimpleUsers();
	$admin = $customer->getInfo('Admin');
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | Our feed back portal</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
 
	
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/tms-0.3.js"></script>
	<script src="js/tms_presets.js"></script>
    <script src="js/cufon-yui.js"></script>
    <script src="js/Vegur-L_300.font.js"></script>
    <script src="js/Vegur-M_500.font.js"></script>
    <script src="js/Vegur-R_400.font.js"></script>
    <script src="js/cufon-replace.js"></script>
    <script src="js/tabs.js"></script>
    <script src="js/FF-cash.js"></script>
    <script>
		$(window).load(function(){
			$('.slider')._TMS({
			prevBu:'.prev',
			nextBu:'.next',
			pauseOnHover:true,
			pagNums:false,
			duration:800,
			easing:'easeOutQuad',
			preset:'Fade',
			slideshow:7000,
			pagination:'.pagination',
			waitBannerAnimation:false,
			banners:'fromLeft'
			})
		}) 	
    </script>
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   	Feed back index page
	<![endif]-->
</head>
<body>
<!--==============================header=================================-->
<header>
  	<div class="main">
      <h1><a href="index.php"><img src="images/logo.png" alt=""></a></h1>
      <nav>
          <ul class="menu">
              <li class="current"><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
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
<section id="content" class="border"><div class="ic"></div>
	<div class="container_12">
      <div class="grid_4">
        <div class="block-1">
              <h3>Complaint  </h3>
              <p class="color-1">Kindly open this link to lodge a complaint about any of our products or services. </p>
            <a href="complaint.php" class="button">Complaint Form </a>          </div>
      </div>
      <div class="grid_4">
        <div class="block-1">
              <h3>Feedback</h3>
              <p class="color-1">You can use this form to give us feed back about our products and services.</p>
            <a href="feedback.php" class="button">Feed back form</a>          </div>
      </div>
      <div class="grid_4">
        <div class="block-1">
            <h3>Contact us </h3>
              <p class="color-1">Kindly open this link to call our support lines </p>
            <a href="contacts.php" class="button">Contact us</a>          </div>
      </div>
      <div class="grid_8">
      	<div class="left-1 page1-col1">
            <h2 class="h2">Welcome to our feed back portal.</h2>
            <p class="color-1 p2">Cola Buster Limited,  a fictive company herein deemed to have been established in 1990, has branches  all over Ghana. </p>
            <p>This owned by Mr. John Smith is located in Accra. Among others,  Cola&nbsp;Buster Company specializes in the production of chocolate, toffees,  drinks and its subsidiaries for a variety of age groups i.e. ranging between  children, adults to the very aged.&nbsp;</p>
            <div class="block-2 wrap">
                <a href="about.php">Read More</a>
                <p class="extra-wrap">About <strong>our made in </strong><strong>Ghana</strong><strong>products</strong></p>
          </div>
            <p>For some time now, Cola Buster  limited has been facing crucial marketing related problems such as effective  capturing of what the customers think of their products.</p>
            <div class="page1-img1"></div>
        </div>
      </div>
      <div class="grid_4">
        <h2 class="left-1">Products</h2>
        <div class="tabs">
            <ul class="nav">
               <li class="selected"><a href="#tab-1">Latest</a></li>
               <li><a href="#tab-2">Popular</a></li>
               <li><a href="#tab-3">More</a></li>
            </ul>
            <div id="tab-1" class="tab-content">
               <div class="inner">
                    <div class="wrap block-3 border-1">
                    	<img src="images/page1-img2.jpg" alt="" class="img-indent">
                        <div class="extra-wrap">
                        	<p class="color-1">Chocolates</p>
                            <p>We have the best chocolate. </p>
                          <p class="color-2">
                            <time datetime="2012-02-18"></time>
                          </p>
                        </div>
                    </div>
                    <div class="wrap block-3">
                    	<img src="images/page1-img3.jpg" alt="" class="img-indent">
                        <div class="extra-wrap">
                        	<p class="color-1"> Toffees </p>
                            <p>We have got all flavors of toffees </p>
                          <p class="color-2"><time datetime="2012-02-18"></time>
                            </p>
                        </div>
                    </div>
               </div>  
            </div>
            <div id="tab-2" class="tab-content">
               <div class="inner">
               		<div class="wrap block-3 border-1">
                    	<img src="images/page1-img3.jpg" alt="" class="img-indent">
                        <div class="extra-wrap">
                        	<p class="color-1">Toffes</p>
                            <p>We have got all flavors of toffees </p>
                          <p class="color-2"><time datetime="2012-02-18"></time>
                            </p>
                        </div>
                    </div>
                    <div class="wrap block-3">
                    	<img src="images/new3.jpg" alt="" width="74" height="74" class="img-indent">
                        <div class="extra-wrap">
                        	<p class="color-1">Biscuit</p>
                            <p>Best of all Biscuits. </p>
                          <p class="color-2"><time datetime="2012-02-18"></time>
                            </p>
                        </div>
                 </div>
               </div>  
            </div>
            <div id="tab-3" class="tab-content">
              <div class="inner">
                    <div class="wrap block-3 border-1">
                    	<img src="images/new6.jpg" alt="" width="74" height="74" class="img-indent">
                        <div class="extra-wrap">
                        	<p class="color-1">Corn Flakes </p>
                            <p>Made with the finest of ingredients. </p>
                          <p class="color-2"><time datetime="2012-02-18"></time>
                            </p>
                        </div>
                </div>
                    <div class="wrap block-3">
                    	<img src="images/new4.jpg" alt="" width="74" height="74" class="img-indent">
                        <div class="extra-wrap">
                        	<p class="color-1">Weta Bix </p>
                            <p>The best wheat meal ever. </p>
                          <p class="color-2">
                            <time datetime="2012-02-18"></time>
                            </p>
                        </div>
                </div>
              </div>   
            </div>
        </div>                        
      </div>
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
