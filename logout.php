<?php
include 'includes/config.php';
unset($_SESSION['clinicID']);
unset($_SESSION['doctorID']);
unset($_SESSION['staffID']);
			unset($_SESSION['surname']);
			unset($_SESSION['othernames']);
			unset($_SESSION['state']);
			unset($_SESSION['age']);
			unset($_SESSION['address']);
			unset($_SESSION['phone']);
			unset($_SESSION['gender']);
			
			setcookie("remember_me", "", -86400);	
header("Location: index");
			?>