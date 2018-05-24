<?php
if(isset($_COOKIE['remember_me']) && !isset($_SESSION['clinicID'])) {
	$remember = filter_var($_COOKIE['remember_me'], FILTER_SANITIZE_STRING);
	$query = "SELECT * FROM patients WHERE remember='$remember'";
if(mysqli_num_rows(mysqli_query($con,$query))==1) {
			$login = mysqli_fetch_assoc(mysqli_query($con,$query));
			session_regenerate_id(true);
			$_SESSION['clinicID'] = $login['clinicID'];
			$_SESSION['userName'] = $login['fullname'];
			$_SESSION['address'] = $login['address'];
			$_SESSION['phone'] = $login['phone'];
			$_SESSION['gender'] = $login['gender'];
}
}		 
?>