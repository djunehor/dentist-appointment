<?php
//ensure no server sde errors are outputted for user
require 'includes/config.php';
if(!isset($_SESSION['doctorID'])) {
die("Error: You cannot perform this action!");	
}
//set variables names
@$userID= $_REQUEST['pid'];
if(!is_numeric($userID)) {
$error = "Invalid Selection!";	
} elseif(mysqli_num_rows(mysqli_query($con,"SELECT clinicID FROM patients WHERE clinicID='$userID'"))!=1) {
$error ="Patient does not exist!";	
} else {
$delete_user = mysqli_query($con,"DELETE FROM patients WHERE clinicID='$userID'");
if($delete_user) {
			$result = "Patient Data has been deleted! <script>$(app".$userID.").hide();</script>";
} else {
	$error = "Unexpected Error occured. Try again later!";	
		}
}
echo isset($error) ? "Error: ".$error : $result;
?>