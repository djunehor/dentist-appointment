<?php
$page_title = "Staff Profile";
include 'header.php';
if(isset($_GET['id'])) {
$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM doctors WHERE docID='$id'"));
}
?>
<h2 style="text-align:center;"><?php echo $page_title; ?></h2>
<div style="display:none" class="alert alert-danger"></div>
<form class="myform" id="staff_form" role="form">
<?php if(!isset($_SESSION['doctorID'])) { 
die( '<div class="alert alert-danger">You are not allowed to view this page</div>');
}?>
<input class="name" type="text" name="fullname" value="<?php echo $p['fullname']; ?>" placeholder="Fullname" required >
		<input type="text" name="username" value="<?php echo $p['username']; ?>" placeholder="Username" required />
		<input type="hidden" name="staffID" value="<?php echo $p['docID']; ?>" />
		<input type="hidden" name="stype" value="<?php if(isset($p['docID'])) {echo 2;} else{echo 1;} ?>" />
		<p>Leave blank if you do not wish to change patient password</p>	
		<input class="name" type="password" name="password" id="password" placeholder="New Password" />	
		<input class="name" type="password" name="cpassword" id="confirm_pass" onchange="confirm_pw(this.value)" placeholder="Confirm Password" />	

		 <div style="display:none" class="alert alert-success success"></div>
													<div style="display:none" class="alert alert-info loading">Loading...</div>
													<div style="display:none" class="alert alert-danger error"></div>
		 <input type="submit" id="btnUpdate" value="<?php if(isset($p['docID'])) {echo "Update Profile";} else {echo "Add Staff";} ?>">
 </form>
  <script>
$(document).ready(function (e) {
	$("#staff_form").on('submit',(function(e) {
		e.preventDefault();
		$('.loading').show();
		$('.success').hide();
		$('.error').hide();
		$('#btnUpdate').attr('disabled','disabled');
		$.ajax({
			url: "ajax_update_staff",
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