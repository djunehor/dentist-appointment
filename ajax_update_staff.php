<?php
//ensure no server side errors are outputted for user
require 'includes/config.php';
if(!isset($_SESSION['doctorID'])) {
die("Error: You cannot perfom this action");	
}
//get variables from $REQUEST superglobal
$array=array("fullname","username","staffID","password","cpassword","stype");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}
//set variables names
$fullname= filter_var($fullname, FILTER_SANITIZE_STRING);
$username = filter_var($username, FILTER_SANITIZE_STRING);
$staffID = filter_var($staffID, FILTER_SANITIZE_STRING);
$stype = filter_var($stype, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);
$cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);
$hpassword = md5($password); //hash password
//new staff
if($stype==1) {
	//check if username valid
	if(strlen($username)<4) {
		$error = "Username cannot be less than 4 characters";
	}
	//check if username exists
elseif(mysqli_num_rows(mysqli_query($con,"SELECT * FROM doctors WHERE username='$username'"))==1) {
	$error = "Username already exists";
	}
	elseif(strlen($password)<8) {
		$error = "Password cannot be less than 8 characters";
	}
elseif($password!=$cpassword) {
		$error = "New Passwords do not match";
	}
else {
	$pword = md5($password);
	$add = time();
$query = "INSERT into doctors (fullname,username,password,addDate) VALUES('$fullname','$username','$pword','$add')";	
$result = "New Staff Added<br>Username: $username<br>Password: $password";	
}
}

//update staff
elseif($stype==2) {
	//check if username valid
	if(strlen($username)<4) {
		$error = "Username cannot be less than 4 characters";
	}
	//check if username exists
elseif(mysqli_num_rows(mysqli_query($con,"SELECT * FROM doctors WHERE docID='$staffID'"))!=1) {
	$error = "Staff does not exist";
	}
else {
$query = "UPDATE doctors SET fullname='$fullname',username='$username'";	
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
$result = "Profile Update successful<br>Username: $username<br>Password: $password";	
	}
}
$query .= " WHERE docID='$staffID'";
}
//Update patient
if(!$error) {
    $run = mysqli_query($con,$query) or die("Query Error: ".mysqli_error($con));
}
echo isset($error) ? "Error: ".$error : $result;
?>