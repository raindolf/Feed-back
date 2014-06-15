<?php


include './functions.php';


if (isset($_POST['feedback'])) {
    // redirect_to("addmember1hh.php");
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])) {



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

if (isset($_POST['compliant'])) {
    // redirect_to("addmember1hh.php");
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])) {



        $msg = new_comp($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['mobile'], $_POST['pid'], $_POST['branch'], $_POST['emp'],$_POST['comp']);

        //f_registration_page.php#tabs-1");
  
        $_SESSION['success'] = "Member successfully added";

        redirect_to("thankyou.php");
    }


    // }
}

