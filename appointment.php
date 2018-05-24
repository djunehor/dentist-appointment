<?php
$page_title = "Book an Appointment";
include 'views/front_header.php';
?>
<!-- Appointment -->
<style>
input[type="password"],input[type="time"],input[type="date"],input[type="tel"] {
	width: 49%;
    float: left;
    color: #000;
    outline: none;
    font-size: 14px;
    padding: 10px 10px;
    border: none;
    border-bottom: 2px solid #fe4630;
    -webkit-appearance: none;
    margin: .3em 0em 1em 0em;
    font-family: 'Roboto', sans-serif;
    background: transparent;
}
</style>
<div class="appointment">
   <div class="container">
	<div class="form-agileits">
	<h3>Make an appointment</h3>
	<p>Providing Total Health Care Solution</p>
	<form id="appointment_form" role="form">
		<input  class="name" type="text" name="fullname" value="<?php echo $_SESSION['fullname']; ?>" placeholder="Patient Name" required >
		<input type="tel" name="phone" value="<?php echo $_SESSION['phone']; ?>" placeholder="Phone" required />
		<input type="hidden" name="clinicID" value="<?php echo $_SESSION['clinicID']; ?>" />
		<input class="name" type="text" name="address" value="<?php echo $_SESSION['address']; ?>" placeholder="Address" required />
		<input name="adate" type="date" required >
		<textarea class="form-control" type="text" name="symptom" placeholder="Comments"></textarea>
		<select class="form-control name" name="gender">
			<option>Gender</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
		</select>
		<input type="datetime" name="atime" />
		<?php if(!isset($user)) { ?>
		<input type="password" name="password" id="password" class="name" placeholder="Password" required />
		<input type="password" name="cpassword" id="confirm_pass" onblur="confirm_pw(this.value)" placeholder="Confirm Password" required />
		<?php } ?>
		 <br><input type="submit" id="btnAppoint" value="Make an appointment">
		 	<div style="display:none" class="alert alert-success success"></div>
													<div style="display:none" class="alert alert-info loading">Loading...</div>
													<div style="display:none" class="alert alert-danger error"></div>
	</form>
	</div>
	<div class="timings-w3ls">
							<h5>Appointment Days</h5>
							<ul>
								<li>Pediatric <span>Sun-Tue</span></li>
								<li>Gynaecology<span>Wed-Fri</span></li>
								<li>Cardiac<span>Sat-Mon</span></li>
							</ul>
	</div>
	<div class="w3ls-location">
		<a href="locations.html">Locations</a>
	</div>
	</div>
	
	<div class="clearfix"> </div>
</div>
	<!-- //Appointment --> 
<script>
$(document).ready(function (e) {
	$("#appointment_form").on('submit',(function(e) {
		e.preventDefault();
		$('.loading').show();
		$('.success').hide();
		$('.error').hide();
		$('#btnAppoint').attr('disabled','disabled');
		$.ajax({
			url: "ajax_appointment",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				$('#btnAppoint').removeAttr('disabled');
				$('.loading').hide();
				
				if(data.search("Error")!=-1){
					$('.error').show();
					$('.success').hide();
					$('.error').html(data);
				}
				else{
					$('.success').show();
					$('.error').hide();
					$('.success').html(data);
				}
			}
		});
	}));
});
function confirm_pw(value){
	var pw=$('#password').val();
	if(pw!=value){
		$('.error').show();
		$('.error').html('The same password should be entered in both fields. Please, re-enter the password correctly.');
		$('#btnSubmit').attr('disabled','disabled');
	}else{
		$('.error').hide();
		$('#btnAppoint').removeAttr('disabled');
	}
}
	</script>
	<!-- Calendar -->
				<script src="assets/js/jquery-ui.js"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script>
			<!-- //Calendar -->

<?php
include 'views/front_footer.php';
?>