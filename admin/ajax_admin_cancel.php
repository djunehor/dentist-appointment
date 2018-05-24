<?php
//ensure no server sde errors are outputted for user
require '../includes/config.php';
require '../includes/admin-auth.php';

//set variables names
@$userID= $_REQUEST['pid'];

if(!is_numeric($userID)) {
$error = "Invalid Selection!";	
} elseif(mysqli_num_rows(mysqli_query($con,"SELECT aID FROM appointments WHERE aID='$userID'"))!=1) {
$error ="Appointment does not exist!";	
} else {
$delete_user = mysqli_query($con,"UPDATE appointments SET status=2 WHERE aID='$userID'");
if($delete_user) {
			$result = "Appointment has been cancelled! <script>$(app".$userID.").hide();</script>";
} else {
	$error = "Unexpected Error occured. Try again later!";	
		}
}
echo isset($error) ? "Error: ".$error : $result;
?>