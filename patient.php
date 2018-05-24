<?php
$page_title = "Patient Profile";
include 'header.php';
$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM patients WHERE clinicID='$id'"));
?>
<h2 style="text-align:center;"><?php echo $page_title; ?></h2>
<div style="display:none" class="alert alert-danger error"></div>
<form class="myform" id="profile_form" role="form">
<?php if(!isset($_SESSION['doctorID']) && !isset($_SESSION['staffID'])) { 
die( '<div class="alert alert-danger">You are not allowed to veiw this page</div>');
}
if(isset($_GET['search']) && empty($p['clinicID'])) { 
die( '<div style="width:300%;" class="alert alert-danger">Patient Record Not found!</div>');
}
?>
<input class="name" type="text" name="surname" value="<?php echo $p['surname']; ?>" placeholder="Surname" required >
		<input type="text" name="othernames" value="<?php echo $p['othernames']; ?>" placeholder="Other Names" required />
		<input type="tel" name="phone" value="<?php echo $p['phone']; ?>" placeholder="Phone" required />
		<input type="hidden" name="clinicID" value="<?php echo $p['clinicID']; ?>"/>
<select class="form-control name" name="state">
			<option value="<?php echo $p['state']; ?>" selected><?php echo $p['state']; ?></option>
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

		<input class="name" type="text" name="address" value="<?php echo $p['address']; ?>" placeholder="Address" required />
		<select class="form-control name" name="gender">
			<option>Gender</option>
			<option value="male" <?php if($p['gender']=='male') {echo 'selected';}?>>Male</option>
			<option value="female" <?php if($p['gender']=='female') {echo 'selected';}?>>Female</option>
		</select>
		<input class="name" type="number" name="age" value="<?php echo $p['age']; ?>" placeholder="Age" required />
		<p>Leave blank if you do not wish to change patient password</p>	
		<input class="name" type="password" name="password" id="password" placeholder="New Password" />	
		<input class="name" type="password" name="cpassword" id="confirm_pass" onblur="confirm_pw(this.value)" placeholder="Confirm Password" />	
		<hr>
		<textarea name="diagnosis" placeholder="Diagnosis"><?php echo $p['diagnosis']; ?></textarea>
		<textarea name="prescription" placeholder="Presciption"><?php echo $p['prescription']; ?></textarea>
		<textarea name="treatment" placeholder="Treatment"><?php echo $p['treatment']; ?></textarea>
		<textarea name="therapy" placeholder="Therapy"><?php echo $p['therapy']; ?></textarea>
		 <div style="display:none" class="alert alert-success success"></div>
													<div style="display:none" class="alert alert-info loading">Loading...</div>
													<div style="display:none" class="alert alert-danger error"></div>
		 <input type="submit" id="btnUpdate" value="Update Profile" <?php if(!isset($_SESSION['doctorID'])) { echo 'disabled';} ?>>
 </form>
  <script>
$(document).ready(function (e) {
	$("#profile_form").on('submit',(function(e) {
		e.preventDefault();
		$('.loading').show();
		$('.success').hide();
		$('.error').hide();
		$('#btnUpdate').attr('disabled','disabled');
		$.ajax({
			url: "ajax_update_profile",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				$('#btnUpdate').removeAttr('disabled');
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