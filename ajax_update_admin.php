<?php
//ensure no server side errors are outputted for user
require 'includes/config.php';
if(!isset($_SESSION['doctorID'])) {
die("Error: You cannot perfom this action");	
}
//get variables from $REQUEST superglobal
$array=array("fullname","username","password","cpassword","email","address","phone","docID");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}
//set variables names
$fullname= filter_var($fullname, FILTER_SANITIZE_STRING);
$username = filter_var($username, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_STRING);
$address = filter_var($address, FILTER_SANITIZE_STRING);
$phone = filter_var($phone, FILTER_SANITIZE_STRING);
$docID = filter_var($docID, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);
$cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);
$hpassword = md5($password); //hash password


	//check if username valid
	if(strlen($username)<4) {
		$error = "Username cannot be less than 4 characters";
	}
	elseif(filter_var($email, FILTER_VALIDATE_EMAIL)===false){ //Validating Email
    $error = "Enter a valid Email";
}
	//check if username exists
elseif(mysqli_num_rows(mysqli_query($con,"SELECT * FROM doctors WHERE docID='$docID'"))!=1) {
	$error = "Doctor does not exist";
	}
else {
$query = "UPDATE doctors SET fullname='$fullname',username='$username',email='$email',address='$address',phone='$phone'";	
}
	if(!empty($password) && !empty($cpassword)) {
		if(strlen($password)<8) {
		$error = "Password cannot be less than 8 characters";
	}
elseif($password!=$cpassword) {
		$error = "New Passwords do not match";
	}
	else {
	$pword = md5($password);
$query .= ",password='$pword'";	
$res = "New Password is $password";
	}
}
$query .= " WHERE docID='$docID'";
$result = "Profile Update successful. $res";
//Update patient
if(!$error) {
    $run = mysqli_query($con,$query) or die("Query Error: ".mysqli_error($con));
}
echo isset($error) ? "Error: ".$error : $result;
?>