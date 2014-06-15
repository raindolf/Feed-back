<?php 
	session_start();
	require_once(dirname(__FILE__)."/customer/simpleusers/su.inc.php");

	$customer = new SimpleUsers();
	
	if(!$_GET['id']){
				header("Location: index.php");
				exit;
		}
			
	if(!$customer->logged_in){
				header("Location: customer/login.php");
				exit;
		}
		
	$admin = $customer->getInfo('Admin');
	$customerInfo = $customer->getSingleUser();
	$branches = $customer->getBranches();
	$employees = $customer->getEmployees();
	$products = $customer->getProducts();
	$nameArray = explode(" ", $customerInfo['Name']);
	
$mysqli = new mysqli($GLOBALS["mysql_hostname"], $GLOBALS["mysql_username"], $GLOBALS["mysql_password"], $GLOBALS["mysql_database"]); 

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}else{
$query = "SELECT id,product, branch, employee, feedback,suggestion FROM feedback WHERE id='".$mysqli->real_escape_string($_GET['id'])."' LIMIT 1";
 if ($feedback = $mysqli->query($query)) {
 	$data = $feedback->fetch_object();
 	$psuggestion = $data->suggestion;
 	$pfeedback = $data->feedback;
 	$pproduct =  $data->product;
 	$pemployee = $data->employee;
 	$pid = $data->id;
 	
 }
 }
 
 
 	
if (isset($_POST['feedback'])) {
    // redirect_to("addmember1hh.php");
   if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])) {

$mysqli = new mysqli($GLOBALS["mysql_hostname"], $GLOBALS["mysql_username"], $GLOBALS["mysql_password"], $GLOBALS["mysql_database"]); 

/* check connection */

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}else{
$customerId = $_POST['customerId'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$product= $_POST['pid'];
$branch = $_POST['branch'];
$employee = $_POST['employee'];
$feed =  $_POST['feed'];
$suggestion = $_POST['suggestion'];

$query = "UPDATE feedback SET product = '".$product."', branch = '".$branch."', employee = '".$employee."', feedback = '".$feed."', suggestion = '".$suggestion."' WHERE id='".$pid."' ";
        
  if ($result = $mysqli->query($query)) {

    /* free result set */
    $mysqli->close();
    $_SESSION['success'] = "Member successfully added";

    header("Location: thankyou.php");
}else{
/* 		printf("Error: %s\n", $mysqli->error); */
	
  if ($mysqli->error) {
    try {    
        throw new Exception("MySQL error $mysqli->error <br> Query:<br> $query", $msqli->errno);    
    } catch(Exception $e ) {
        echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
        echo nl2br($e->getTraceAsString());
    }
    

 }

}      
}
}
}


       /*
 //$msg = new_feedback($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['mobile'], $_POST['pid'], $_POST['branch'], $_POST['emp'],$_POST['comp']);
        $msg = new_feedback($_POST['customerId'],$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['mobile'], $_POST['pid'],$_POST['branch'],$_POST['employee'], $_POST['feed'],$_POST['suggestion']);

        //f_registration_page.php#tabs-1");
   
        //session_start(); 
        //$_SESSION['id'] = $_POST['staff_id'];
        //   redirect_to("staff_registration_update.php#tabs-2");
        $_SESSION['success'] = "Member successfully added";

        redirect_to("thankyou.php");
    }
    // }
}
*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Feedback</title>
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
<br>



<div align="center" > <h2 class="style1" > Kindly submit your feed back about our product here </h2> 
</div>

<div id="page-wrap">
		<div id="contact-area">
		

<form action="" method="post" id="myform" class="form-horizontal">
  <fieldset>

  <div class="control-group">
                                <label class="control-label" for="input01"> 
                                    <div align="center" class="style1">First Name </div>
</label>
                                <div class="controls">
                                    <div align="center">
                                        <input type="text" name="fname" class="input-xlarge" value="<?php echo $nameArray[0]; ?>" id="input01">
                                          
                                      </div>
      </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">
                                    <div align="center" class="style1">Last Name</div>
                                    </label>
                                    <div class="controls">
                                        <div align="center">
                                          <input type="text" name="lname" class="input-xlarge" value="<?php echo $nameArray[1]; ?>" id="input01">
                                          
                                            </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input01"> 
                                    <div align="center" class="style1">Email </div>
                                    </label>
                                    <div class="controls">
                                        <div align="center">
                                          <input type="text" name="email" class="input-xlarge" id="input01" value="<?php echo $customerInfo['Email']; ?>" required>
                                          
                                            </div>
                                    </div>
                                </div>
                             
                                 <div class="control-group">
                                    <label class="control-label" for="input01"> 
                                    <div align="center" class="style1">Mobile Number </div>
                                    </label>
                                    <div class="controls">
                                        <div align="center">
                                          <input type="text" name="mobile" class="input-xlarge" value="<?php echo $customerInfo['Mobile']; ?>" id="input01">
                                          
                                            </div>
                                    </div>
                                </div>
                               
                               
                                
                                 <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">
                                    <div align="center" class="style1">Product</div>
                                    </label>
                                    <div class="controls">
                                        
<!--                                         <div align="center"> -->
                                         <?php
                                        $selectTag = "<select name='pid' >";
									    foreach ($products as $select_query_display){
									    foreach ($select_query_display as $select_query_display_value){
									        $selectTag .="<option name='pid' pproduct==$select_query_display_value ? selected='selected' value='$select_query_display_value' >$select_query_display_value</option>";
									    }
									    }
									
									$selectTag .= "</select>";
									
									   echo $selectTag;
									   ?>
                                          
                                      </div>
<!--                                     </div> -->
                                    <br />
                                    
                                    
                                    <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">
                                    <div align="center" class="style1">Branch</div>
                                    </label>
                                    <div class="controls">
                                        
<!--                                         <div align="center"> -->
                                         <?php
                                        $selectTag = "<select name='branch'>";
									    foreach ($branches as $select_query_display){
									    foreach ($select_query_display as $select_query_display_value){
									        $selectTag .="<option name='branch' pbranch==$select_query_display_value ? selected='selected' value='$select_query_display_value' >$select_query_display_value</option>";
									    }
									    }
									
									$selectTag .= "</select>";
									
									   echo $selectTag;
									   ?>
                                          
                                      </div>
<!--                                     </div> -->
                                    <br />
                                    
                                    
                                    <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">
                                    <div align="center" class="style1">Employee</div>
                                    </label>
                                    <div class="controls">
                                        
<!--                                         <div align="center"> -->
                                         <?php
                                        $selectTag = "<select name='employee'>";
									    foreach ($employees as $select_query_display){
									    foreach ($select_query_display as $select_query_display_value){
									        $selectTag .="<option name='employee' pemployee==$select_query_display_value ? selected='selected' value='$select_query_display_value' >$select_query_display_value</option>";
									    }
									    }
									
									$selectTag .= "</select>";
									
									   echo $selectTag;
									   ?>
                                          
                                      </div>
                                    </div>
                                    
                                    
                                    <br />
                                    <label>
                                    <div align="center" class="style1">Your Feedback About the product</div>
                                    </label>
                                    <p align="center"> <textarea name="feed" required><?php echo $pfeedback ?></textarea></p>
                                    <label>
                                    <div align="center" class="style1">Any Suggestions</div>
                                    </label>
                                    <p align="center"><textarea name="suggestion" required><?php echo $psuggestion ?></textarea></p>
                                    <input type="hidden" name="customerId" value="<?php echo $_SESSION["SimpleUsers"]["customerId"]; ?>" >
                                </div>
                            </fieldset>

                            </p>
               
                    <div class="modal-footer">
                        <div align="center">
                          <input type="submit" value="Update" name="feedback"  class="submit-button"/>
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