<?php


session_start();
include 'config.php';

function new_feedback($fname, $lname, $email, $mobile, $pid, $employee, $branch, $suggestion,$feed) {
    $con = getCons();

    
        $query = "INSERT INTO `feedback`(`customerId`,`fname`, `lname`, `email`, `mobile_number`, `product`,`branch`,`employee`, `feedback`, `suggestion`) VALUES(1,'$fname','$lname','$email','$mobile','$pid',$branch, $employee,'$feed','$suggestion')";
        $result = $con->query($query);
/*         $id = mysql_insert_id(); */
        $id = 'success';

       
        closeCons($con);
  //  }
    return $id;
}
function new_comp($fname, $lname, $email, $mobile, $pid,$branch,$emp,$comp) {
    $con = getCons();

    
        $query = "INSERT INTO `complaint`(`fname`, `lname`, `email`, `mobile_number`, `branch_visited`, `emp_name`, `complaint`) VALUES('$fname','$lname','$email','$mobile', '$branch','$emp','$comp')";
        $result = mysql_query($query);
        // $id = mysql_insert_id();
        $id = 'success';
       
        closeCons($con);
  //  }
    return $id;
}

function get_feedback_by_user($user_id){
$con = getCons();

$query = "SELECT * FROM `feedback` WHERE `user_id` ==`$user_id`";
$result = mysql_query($query);

closeCons($con);

return $result;
}

function get_comp_by_user($user_id){
$con = getCons();

$query = "SELECT * FROM `complaint` WHERE `user_id` ==`$user_id`";
$result = mysql_query($query);

closeCons($con);

return $result;
}

function redirect_to($location) {
    header("location: " . $location);
}
