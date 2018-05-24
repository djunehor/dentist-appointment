<?php
$page_title = "New Appointment";
include 'header.php';
?>
<h2 style="text-align:center;"><?php echo $page_title; ?></h2>
 <form class="myform" id="appointment_form" role="form">
<input class="name" type="text" name="surname" value="<?php echo $_SESSION['surname']; ?>" placeholder="Surname" required >
		<input type="text" name="othernames" value="<?php echo $_SESSION['othernames']; ?>" placeholder="Other Names" required />
		<input type="tel" name="phone" value="<?php echo $_SESSION['phone']; ?>" placeholder="Phone" required />
		<input type="hidden" name="clinicID" value="<?php echo $_SESSION['clinicID']; ?>" />
		<input name="adate" type="date" placeholder="Date" min="<?php echo date('Y-m-d'); ?>" required >	
		
		<input type="time" name="atime" placeholder="Time" />
<select class="form-control name" name="state">
			<option value="<?php echo $_SESSION['state']; ?>" selected><?php echo $_SESSION['state']; ?></option>
			<option>State</option>
			 <option value="Abuja FCT">Abuja FCT</option>
              <option value="Abia">Abia</option>
              <option value="Adamawa">Adamawa</option>
              <option value="Akwa Ibom">Akwa Ibom</option>
              <option value="Anambra">Anambra</option>
              <option value="Bauchi">Bauchi</option>
              <option value="Bayelsa">Bayelsa</option>
              <option value="Benue">Benue</option>
              <option value="Borno">Borno</option>
              <option value="Cross River">Cross River</option>
              <option value="Delta">Delta</option>
              <option value="Ebonyi">Ebonyi</option>
              <option value="Edo">Edo</option>
              <option value="Ekiti">Ekiti</option>
              <option value="Enugu">Enugu</option>
              <option value="Gombe">Gombe</option>
              <option value="Imo">Imo</option>
              <option value="Jigawa">Jigawa</option>
              <option value="Kaduna">Kaduna</option>
              <option value="Kano">Kano</option>
              <option value="Katsina">Katsina</option>
              <option value="Kebbi">Kebbi</option>
              <option value="Kogi">Kogi</option>
              <option value="Kwara">Kwara</option>
              <option value="Lagos">Lagos</option>
              <option value="Nassarawa">Nassarawa</option>
              <option value="Niger">Niger</option>
              <option value="Ogun">Ogun</option>
              <option value="Ondo">Ondo</option>
              <option value="Osun">Osun</option>
              <option value="Oyo">Oyo</option>
              <option value="Plateau">Plateau</option>
              <option value="Rivers">Rivers</option>
              <option value="Sokoto">Sokoto</option>
              <option value="Taraba">Taraba</option>
              <option value="Yobe">Yobe</option>
              <option value="Zamfara">Zamfara</option>
		</select>	

		<input class="name" type="text" name="address" value="<?php echo $_SESSION['address']; ?>" placeholder="Address" required />		
		<textarea class="form-control" type="text" name="symptom" placeholder="Comments" required ></textarea>
		<select class="form-control name" name="gender">
			<option>Gender</option>
			<option value="male" <?php if($_SESSION['gender']=='male') {echo 'selected';}?>>Male</option>
			<option value="female" <?php if($_SESSION['gender']=='female') {echo 'selected';}?>>Female</option>
		</select>
		<input class="name" type="number" name="age" value="<?php echo $_SESSION['age']; ?>" placeholder="Age" required />
		<select class="form-control name" name="therapy">
			<option>Therapy</option>
			<option value="" <?php if($_SESSION['gender']=='male') {echo 'selected';}?>>T2</option>
		</select>
		<?php if(!isset($_SESSION['clinicID'])) { ?>
		<input type="password" name="password" id="password" class="name" placeholder="Password" required />
		<input type="password" name="cpassword" id="confirm_pass" onblur="confirm_pw(this.value)" placeholder="Confirm Password" required />
		<?php } ?>
		
		 <div style="display:none" class="alert alert-success success"></div>
													<div style="display:none" class="alert alert-info loading">Loading...</div>
													<div style="display:none" class="alert alert-danger error"></div>
		 <input type="submit" id="btnAppoint" value="Make an appointment">
 </form>
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
<?php include 'footer.php'; ?>