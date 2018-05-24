<?php
//ensure no server side errors are outputted for user
require 'includes/config.php';

//get variables from $REQUEST superglobal
$array=array("surname","othernames","clinicID","phone","address","opassword","password","cpassword","gender","state","age","therapy","prescription","treatment","diagnosis");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}

//set variables names
$therapy= filter_var($therapy, FILTER_SANITIZE_STRING);
$treatment = filter_var($treatment, FILTER_SANITIZE_STRING);
$prescription = filter_var($prescription, FILTER_SANITIZE_STRING);
$diagnosis = filter_var($diagnosis, FILTER_SANITIZE_STRING);
$surname = filter_var($surname, FILTER_SANITIZE_STRING);
$othernames = filter_var($othernames, FILTER_SANITIZE_STRING);
$state = filter_var($state, FILTER_SANITIZE_STRING);
$age = filter_var($age, FILTER_SANITIZE_STRING);
$clinicID = filter_var($clinicID, FILTER_SANITIZE_STRING);
$phone = filter_var($phone, FILTER_SANITIZE_STRING);
$address = filter_var($address, FILTER_SANITIZE_STRING);
$atime = filter_var($atime, FILTER_SANITIZE_STRING);
$opassword = filter_var($opassword, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);
$cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);
$hpassword = md5($password); //hash password
$query = "UPDATE patients SET surname='$surname',othernames='$othernames',age='$age',state='$state',phone='$phone',gender='$gender',address='$address'";
//already logged in member
if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM patients WHERE clinicID='$clinicID'"))!=1) {
	$error = "No record was found";
	}
elseif(!empty($opassword) && $opassword!=$_SESSION['password']) {
		$error = "Old Password not correct";
	}
elseif(!empty($password) && $password!=$cpassword) {
		$error = "New Passwords do not match";
	}
elseif(!empty($password) && strlen($password)<8) {
		$error = "Passwords cannot be less than 8 characters";
	}
	elseif(!empty($password) && empty($opassword) && !isset($_SESSION['doctorID'])) {
		$error = "Old password must be provided";
	}
elseif(!empty($password) && ($opassword==$_SESSION['password'] || isset($_SESSION['doctorID']))) {
		$query .= ",password='$hpassword'";
	}
	
//admin update
if(isset($_SESSION['doctorID'])) {
$query .= ",therapy='$therapy',treatment='$treatment',prescription='$prescription',diagnosis='$diagnosis'";
}	
	$query .= " WHERE clinicID='$clinicID'";
//Update patient
    $register = mysqli_query($con,$query) or die("Update Error: ".mysqli_error($con));
	$result = "Profile update successful";

echo isset($error) ? "Error: ".$error : $result;
?>