<!DOCTYPE html>
<html lang="en">
<head>
    <title>Complaint</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
	<link rel="stylesheet" type="text/css" href="css/newstyle.css" />
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
      <h1><a href="index.html"><img src="images/logo.png" alt=""></a></h1>
      <nav>
          <ul class="menu">
              <li><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="feedback.php">Feedback</a></li>
              <li class="current"><a href="complaint.php">Complaint</a></li>
              
              <li><a href="contacts.php">Contacts</a></li>
          </ul>    
      </nav>
    </div> 
</header>   
<section id="header-content"></section>

<br>

<div align="center" > 
  <h2 align="center" class="style1"> Add complaint Here </h2>
</div>	

<?php
        // put your code here
        ?>
		
		<div id="page-wrap">
		<div id="contact-area">
		
		
		
        <form action="process.php" method="post" name="myform" class="form-horizontal" id="myform">
                            <fieldset>

                            <div class="control-group">
                                <label for="input01" class="control-label style1"> 
                                    <div align="center">First Name </div>
                                </label>
                                <div class="controls">
                                    <div align="center">
                                        <input type="text" name="fname" class="input-xlarge" id="input01">
                                          
                                      </div>
                                </div>
                                </div>
                                <div class="control-group">
                                    <label for="optionsCheckbox" class="control-label style1">
                                    <div align="center">Last Name</div>
                                    </label>
                                    <div class="controls">
                                        <div align="center">
                                          <input type="text" name="lname" class="input-xlarge" id="input01">
                                          
                                            </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="input01" class="control-label style1"> 
                                    <div align="center">Email </div>
                                    </label>
                                    <div class="controls">
                                        <div align="center">
                                          <input type="text" name="email" class="input-xlarge" id="input01" required>
                                          
                                            </div>
                                    </div>
                                </div>
                                 
                                 <div class="control-group">
                                    <label for="input01" class="control-label style1"> 
                                    <div align="center">Mobile Number </div>
                                    </label>
                                    <div class="controls">
                                        <div align="center">
                                          <input type="text" name="mobile" class="input-xlarge" id="input01">
                                          
                                            </div>
                                    </div>
                                </div>
                               
                                
                                 <div class="control-group">
                                    <label for="optionsCheckbox" class="control-label style1">
                                    <div align="center">Product ID</div>
                                    </label>
                                    <div class="controls">
                                        
                                        <div align="center">
                                          <input type="text" class="input-xlarge" id="input01" name="pid">
                                          
                                            </div>
                                    </div>
                                    <label>
                                    <div align="center"><span class="style1">Branch Visited</span></div>
                                    </label>
                                    <p align="center"> <input type="text" name="branch" required/></p>
                                   <label>
                                   <div align="center"><span class="style1">Name Of Employee</span></div>
                                   </label>
                                    <p align="center"> <input type="text" name="emp" required/></p>
                                    <label>
                                    <div align="center"><span class="style1">Complaint</span></div>
                                    </label>
                                    <p align="center"> <textarea name="comp" required></textarea></p>
                                </div>
                            </fieldset>

                            </p>
                    s
                    <div class="modal-footer">
                        <div align="center">
                          <input type="submit" value="Submit" name="compliant"  class="submit-button"/>
                            </div>
                    </div>
</form> 

<div style="clear: both;"></div>

</div>


			

<!--==============================content================================-->
<section id="content" class="border subpage-content"><div class="ic"></div>
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