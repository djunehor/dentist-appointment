<?php
//ensure no server side errors are outputted for user
require 'includes/config.php';

//get variables from $REQUEST superglobal
$array=array("surname","othernames","clinicID","phone","address","adate","atime","password","cpassword","gender","symptom","state","age","therapy");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}

//set variables names
$surname = filter_var($surname, FILTER_SANITIZE_STRING);
$othernames = filter_var($othernames, FILTER_SANITIZE_STRING);
$state = filter_var($state, FILTER_SANITIZE_STRING);
$age = filter_var($age, FILTER_SANITIZE_STRING);
$therapy = filter_var($therapy, FILTER_SANITIZE_STRING);
$clinicID = filter_var($clinicID, FILTER_SANITIZE_STRING);
$phone = filter_var($phone, FILTER_SANITIZE_STRING);
$address = filter_var($address, FILTER_SANITIZE_STRING);
$symptom = filter_var($symptom, FILTER_SANITIZE_STRING);
$adate = filter_var($adate, FILTER_SANITIZE_STRING);
$atime = filter_var($atime, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);
$cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);
$hpassword = md5($password); //hash password

//New patient
if(!empty($password) && !empty($cpassword)) {
	//check fullname
	if(!isset($surname)) {
		$error = "Full name is required";
	}
	//check phone
	elseif(!isset($phone)) {
		$error = "Phone number is required";
	}
	//check if password not less than 8 characters
	elseif(strlen($password)<8) {
		$error = "Passwords cannot be less than 8 characters";
	}
	//check if password match
	elseif($password!=$cpassword) {
		$error = "Passwords do not match";
	}
	elseif(mysqli_num_rows(mysqli_query($con,"SELECT * FROM patients WHERE phone='$phone'"))>0) {
	$error = "You are already registered.";
	}
	//insert details into patients
	$reg_time = time();
    $register = mysqli_query($con,"INSERT INTO patients (surname,othernames,age,state,therapy,regDate,phone,gender,password,address) VALUES
	('$surname','$othernames','$age','$state','$therapy','$reg_time','$phone','$gender','$hpassword','$address')") or die("Registration Error: ".mysqli_error($con));
	$row=mysqli_fetch_array(mysqli_query($con,"SELECT clinicID FROM patients WHERE clinicID=(SELECT MAX(clinicID) FROM patients)"));
	$clinicID = $row['clinicID'];
	$result = "A new account has been created. Your clinicID is $clinicID<br>";
} 
//already logged in member
elseif(is_numeric($clinicID)){
	//check if patient exists
	if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM patients WHERE clinicID='$clinicID'"))!=1) {
	$error = "No record was found";
	}
}

//check appointment details

	//check appointment date and time
	if(!isset($adate) || !isset($atime)) {
		$error = "Appointment date and time is required";
	}
	//check if date and time is free
	elseif(mysqli_num_rows(mysqli_query($con,"SELECT * FROM appointments WHERE apDate='$adate' AND apTime='$adate' AND status!=2"))>0) {
		$error = "Selected Date & Time is Booked. Try another date.";
	}
elseif(!isset($error) && is_numeric($clinicID)) {
		//insert appointment details
	$appointment = mysqli_query($con,"INSERT into appointments(clinicID,apDate,apTime,symptom) VALUES('$clinicID','$adate','$atime','$symptom')") or die("Appointment Error: ".mysqli_error($con));
	$result .= "Your appointment has been submitted";
	
	//send admin email
 require_once 'includes/functions.php';	
$message = "<HTML><BODY>
<div style='font-family:arial; border:2px solid #c0c0c0; padding:15px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px;'>
<div style='font-size:22px; color:darkblue; font-weight:bold;'>New Appointment</div>
    <br />
<p>Find appointment details below:
						   <ul>
						   <li>Full name: {$fullname}</li>
						   <li>Date and Time: {$adate},{$atime}</li>
						   <li>Clinic ID: {$clinicID}</li>
						   <li>Comments: {$symptom}</li>
						   </ul><br><br><br>{$website_name}</p>
</div></BODY></HTML>";
						SendMail('noreply@'.$_SERVER['SERVER_NAME'],'New Appointment',$admin_email,$message,$fullname,'Doctor');
}
echo isset($error) ? "Error: ".$error : $result;
?>