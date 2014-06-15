<?php

	/**
	* Make sure you started your'e sessions!
	* You need to include su.inc.php to make SimpleUsers Work
	* After that, create an instance of SimpleUsers and your'e all set!
	*/

	session_start();
	require_once(dirname(__FILE__)."/simpleusers/su.inc.php");

	$SimpleUsers = new SimpleUsers();

	// Validation of input
	if( isset($_POST["username"]) )
	{
		if( empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]) || empty($_POST["name"]) )
			$error = "You have to choose a fullname, username,email and a password";
    else
    {
    
    //compare password and password confirmation
    if(!($_POST['password'] == $_POST['confirm_password'])){
      $error = "Password does not match";
      }
    	// Both fields have input - now try to create the user.
    	// If $res is (bool)false, the username is already taken.
    	// Otherwise, the user has been added, and we can redirect to some other page.
			$res = $SimpleUsers->createUser($_POST["name"],$_POST["email"],$_POST["mobile"],$_POST["username"], $_POST["password"]);


			if(!$res)
				$error = "Username already taken.";
			else
			{
					header("Location: portal.php");
					exit;
			}
		}

	} // Validation end

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Signup</title>
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
              <li><a href="login.php">Login</a></li>
              <li class="current"><a href="register.php">Sign Up</a></li>
          </ul>    
      </nav>
    </div> 
</header>   
<section id="header-content"></section>
<!--==============================content================================-->
<br>



<div align="center" > <h2 class="style1" > Fill the form the register </h2> 
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
                                    <label for="name">Full Name:</label><br />
</label>
                                <div class="controls">
                                    <div align="center">
				<input type="text" name="name" id="name" required/>
                                          
                                      </div>
      </div>
                                </div>
                                
                                  <div class="control-group">
                                <label class="control-label" for="input01"> 
                                    <label for="email">Email:</label><br />
</label>
                                <div class="controls">
                                    <div align="center">
				<input type="email" name="email" id="email" required/>
                                          
                                      </div>
      </div>
                                </div>
                                
                                  <div class="control-group">
                                <label class="control-label" for="input01"> 
                                    <label for="mobile">Mobile:</label><br />
</label>
                                <div class="controls">
                                    <div align="center">
				<input type="text" name="mobile" id="mobile" required/>
                                          
                                      </div>
      </div>
                                </div>
                                
                                
                                

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
                                
                                    <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">
                                    <label for="confirm_password">Confirm Password:</label><br />
                                    </label>
                                    <div class="controls">
                                        <div align="center">
				<input type="password" name="confirm_password" id="confirm_password" required/>
                                          
                                            </div>
                                    </div>
                                </div>
                               
                            </fieldset>

                            </p>
               
                    <div class="modal-footer">
                        <div align="center">
                          <input type="submit" value="Register" name="submit"  class="submit-button"/>
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