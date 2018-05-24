<?php
include 'includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo "$page_title | $website_name"; ?></title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<script src="jquery.js"></script>
</head>
<body style="background-color:green;">

<ul>
  <li><a class="active" href="index">Home</a></li>  
  <li><a href="new-appointment">New Appointment</a></li>
<?php if(!isset($_SESSION['clinicID']) && !isset($_SESSION['doctorID']) && !isset($_SESSION['staffID'])) { ?>
  <li><a href="login">Login</a></li>
<?php } if(isset($_SESSION['clinicID'])) { ?>  
  <li><a href="dashboard">Dashboard</a></li>
  <li><a href="my-appointments">Appointments</a></li>
  <li><a href="edit-profile">Edit Profile</a></li>
  <li><a href="login">Log Out</a></li>
  <?php } ?>
<?php if(isset($_SESSION['doctorID']) || isset($_SESSION['staffID'])) {?> 
  <li><a href="admin-dashboard">Appointments</a></li>
  <li><a href="patients">Patients</a></li>
  <li><a href="admin-login">Admin Logout</a></li>
<?php } if(isset($_SESSION['doctorID'])) {?>
<li><a href="staffs">Staffs</a></li>
<li><a href="specialists">Specialists</a></li>
<li><a href="admin-profile">Update Profile</a></li> <?php } ?>
</ul>
<?php if(isset($_SESSION['doctorID']) || isset($_SESSION['staffID'])) {?>
<form style="position:fixed;top:10%;right:33%;" action="patient" method="get">
<input type="text" name="id" placeholder="Search...">
<input type="hidden" name="search" value="1">
<input type="submit" style="display:none;">
</form>
<?php } ?>
<h2 style="text-align:center;padding-left:19%;"><?php echo $website_name; ?></h2>
<div class="begin">
  