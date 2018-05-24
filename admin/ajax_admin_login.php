<?php
//ensure no server sde errors are outputted for user
require '../includes/config.php';

//get variables from $REQUEST superglobal
$array=array("username","password");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}

//set variables names
$username = filter_var($username, FILTER_SANITIZE_STRING);
$pasword = filter_var($password, FILTER_SANITIZE_STRING);
$pword = md5($pasword); //hash password

$query = "SELECT * FROM doctors WHERE username='$username' AND password='$pword'";
if(mysqli_num_rows(mysqli_query($con,$query))==1) {
			$login = mysqli_fetch_assoc(mysqli_query($con,$query));
			session_regenerate_id(true);
			$_SESSION['doctorID'] = $login['docID'];
			$_SESSION['doctorName'] = $login['fullname'];
			
			$last_login = time();
			//update user last login
			$update_login = mysqli_query($con,"UPDATE doctors SET lastLogin='$last_login' where docID='".$_SESSION['doctorID']."'");
			
			//output to user. Redirect to appropriate page
			$result = 'Login Successful. Redirecting ... <script>window.setTimeout(function(){ window.location = "index"; },3000)</script>';
			$result .= "<script>$('#btnLogin').attr('disabled','disabled');</script>";
} else {
	$error = "Invalid Username or password!";	
		}
echo isset($error) ? "Error: ".$error : $result;