<?php
$page_title = "Patient Profile";
include 'header.php';
?>
<h2 style="text-align:center;">My Profile</h2>
 <form style="padding-left:10%;padding-right:10%;" id="patient_profile" role="form">
 <b>Surname:</b> <?php echo $_SESSION['surname']; ?><br><br>
 <b>Other Names:</b> <?php echo $_SESSION['othernames']; ?><br><br>
 <b>Therapy:</b> <?php echo $_SESSION['therapy']; ?><br><br>
 <b>Card Number:</b> <?php echo $_SESSION['clinicID']; ?><br><br>
 <b>Age:</b> <?php echo $_SESSION['age']; ?><br><br>
 <b>Sex:</b> <?php echo $_SESSION['gender']; ?><br><br>
 <b>State of Origin:</b> <?php echo $_SESSION['state']; ?><br><br>
 <b>Address:</b> <?php echo $_SESSION['address']; ?><br><br>
 <b>Phone Number:</b> <?php echo $_SESSION['phone']; ?><br><br>
</form>
 <?php include 'footer.php'; ?>