<?php

	/**
	* Make sure you started your'e sessions!
	* You need to include su.inc.php to make SimpleUsers Work
	* After that, create an instance of SimpleUsers and your'e all set!
	*/

	session_start();
	require_once(dirname(__FILE__)."/simpleusers/su.inc.php");

	$customer = new SimpleUsers();

	// Login from post data
	if( isset($_POST["username"]) )
	{

		// Attempt to login the user - if credentials are valid, it returns the users id, otherwise (bool)false.
		$res = $customer->loginUser($_POST["username"], $_POST["password"]);
		if(!$res)
			$error = "You supplied the wrong credentials.";
		else
		{
				header("Location: portal.php");
				exit;
		}

	} // Validation end
	
	 if($customer->logged_in){
				header("Location: portal.php");
				exit;
		}
	

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Login</title>
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
              <?php if(!$customer->logged_in): ?>
              <li class="current"><a href="/login.php">Login</a></li>
              <?php endif; ?>
              <?php if(!$customer->logged_in): ?>
              <li><a href="register.php">Sign Up</a></li>
              <?php endif; ?>
              <?php if($customer->logged_in): ?>
              <li><a href="portal.php">Customer Portal</a></li>
              <?php endif; ?>
          </ul>    
      </nav>
    </div> 
</header>   
<section id="header-content"></section>
<!--==============================content================================-->
<br>



<div align="center" > <h2 class="style1" > Welcome back valued customer </h2> 
</div>

<div id="page-wrap">
		<div id="contact-area">
		

<form action="" method="post" id="myform" class="form-horizontal">
  <fieldset>
  
  <?php if( isset($error) ): ?>
		<p>
			<?php echo $error; ?>
		</p>
  <?php endif; ?>
		

  <div class="control-group">
                                <label class="control-label" for="input01"> 
                                    <label for="username">Username:</label><br />
</label>
                                <div class="controls">
                                    <div align="center">
				<input type="text" name="username" id="username" required/>
                                          
                                      </div>
      </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">
                                    <label for="password">Password:</label><br />
                                    </label>
                                    <div class="controls">
                                        <div align="center">
				<input type="password" name="password" id="password" required/>
                                          
                                            </div>
                                    </div>
                                </div>
                               
                            </fieldset>

                            </p>
               
                    <div class="modal-footer">
                        <div align="center">
                          <input type="submit" value="Login" name="submit"  class="submit-button"/>
                            </div>
                   </div>

</form>

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