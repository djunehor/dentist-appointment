<?php
//ensure no server sde errors are outputted for user
require 'includes/config.php';

//get variables from $REQUEST superglobal
$array=array("phone","password","remember");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}

//set variables names
$phone = filter_var($phone, FILTER_SANITIZE_STRING);
$pasword = filter_var($password, FILTER_SANITIZE_STRING);
$remember_me = filter_var($remember, FILTER_SANITIZE_STRING);
$pword = md5($pasword); //hash password

$query = "SELECT * FROM patients WHERE phone='$phone' AND password='$pword'";
if(mysqli_num_rows(mysqli_query($con,$query))==1) {
			$login = mysqli_fetch_assoc(mysqli_query($con,$query));
			session_regenerate_id(true);
			$_SESSION['clinicID'] = $login['clinicID'];
			$_SESSION['surname'] = $login['surname'];
			$_SESSION['othernames'] = $login['othernames'];
			$_SESSION['state'] = $login['state'];
			$_SESSION['age'] = $login['age'];
			$_SESSION['phone'] = $login['phone'];
			$_SESSION['gender'] = $login['gender'];
			$_SESSION['address'] = $login['address'];
			$_SESSION['password'] = $login['password'];
			
			if($remember_me==1) {
				//get strong 64 characters string as unique identifier, save cookie in user browser and save copy in user row;
				$sessionid = bin2hex(openssl_random_pseudo_bytes(32));
				setcookie("remember_me", $sessionid, time() + (86400*30));	
			}
			$last_login = time();
			//update user last login
			$update_login = mysqli_query($con,"UPDATE patients SET lastLogin='$last_login',remember='$sessionid' where clinicID='".$_SESSION['clinicID']."'");
			
			//output to user. Redirect to appropriate page
			$result = 'Login Successful. Redirecting in 3 seconds. <script>window.setTimeout(function(){ window.location = "dashboard"; },3000)</script>';
			$result .= "<script>$('#btnLogin').attr('disabled','disabled');</script>";
} else {
	$error = "Invalid phone or password!";	
		}
echo isset($error) ? "Error: ".$error : $result;