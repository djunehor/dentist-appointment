<?php
//ensure no server side errors are outputted for user
require 'includes/config.php';
if(!isset($_SESSION['doctorID'])) {
die("Error: You cannot perfom this action");	
}
//get variables from $REQUEST superglobal
$array=array("fullname","qua","spID","spec","stype");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}
//set variables names
$fullname= filter_var($fullname, FILTER_SANITIZE_STRING);
$spID = filter_var($spID, FILTER_SANITIZE_STRING);
$stype = filter_var($stype, FILTER_SANITIZE_STRING);
$qua = filter_var($qua, FILTER_SANITIZE_STRING);
$spec = filter_var($spec, FILTER_SANITIZE_STRING);

	if (strlen($_FILES['photo']['name'])>4) { 
	$ext = strtolower(substr($_FILES['photo']['name'],-3));
if ($ext!='jpg')
{
die( "Error: Invalid Photo - Only 'jpg' allowed! Your file ".$_FILES['photo']['name']." is $ext");
}
$filearray = $_FILES['photo'];
						$name = $filearray['name'];
						$tmpName  = $filearray['tmp_name'];
						$uploaddir = 'uploads/';
                      $uploadfile = $uploaddir . basename($name);
                      $url = $uploadfile;
							if (move_uploaded_file($tmpName, $uploadfile))
								{
								echo "Photo <b>".$name."</b> was successfully uploaded. ";
								} else {
								echo "Error: Photo <b>".$name."</b> upload failed! ";	
								}
}
//new specialist
if($stype==1) {
	//check if username valid
	if(strlen($fullname)<10) {
		$error = "Full Name cannot be less than 10 characters";
	}
	//check if username exists
elseif(mysqli_num_rows(mysqli_query($con,"SELECT * FROM specialists WHERE fullname='$fullname'"))==1) {
	$error = "Specialist already exists";
	}
else {
	$add = time();
$query = "INSERT into specialists (fullname,qua,spec,addDate,photo) VALUES('$fullname','$qua','$spec','$add','$url')";	
$result = "New Specialist Added";	
}
}

//update staff
elseif($stype==2) {
	//check if username valid
	if(strlen($fullname)<10) {
		$error = "Fullname cannot be less than 10 characters";
	}
	//check if username exists
elseif(mysqli_num_rows(mysqli_query($con,"SELECT * FROM specialists WHERE spID='$spID'"))!=1) {
	$error = "Specialist does not exist";
	}
else {
	if(!empty($url)) {$ext=",photo='$url'";}
$query = "UPDATE specialists SET fullname='$fullname',qua='$qua',spec='$spec'".$ext." WHERE spID='$spID'";	
$result = "Profile Update successful<br>Username: $username<br>Password: $password";	
}
}
//Update patient
if(!$error) {
    $run = mysqli_query($con,$query) or die("Query Error: ".mysqli_error($con));
}
echo isset($error) ? "Error: ".$error : $result;
?>