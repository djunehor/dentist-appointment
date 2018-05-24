<?php
$page_title = "Admin Login";
session_start();
session_destroy();
include 'header.php';
?>
<h2 style="text-align:center;"><?php echo $page_title; ?></h2>
 <form class="myform" id="login_form" role="form">
<input class="name" type="text" name="username" placeholder="Username" required >
		<input type="password" name="password" placeholder="Password" required />
		 <input type="submit" id="btnLogin" value="Login">
		 <div style="display:none" class="alert alert-success success"></div>
													<div style="display:none" class="alert alert-info loading">Loading...</div>
													<div style="display:none" class="alert alert-danger error"></div>
 </form>
  <script>
$(document).ready(function (e) {
	$("#login_form").on('submit',(function(e) {
		e.preventDefault();
		$('.loading').show();
		$('.success').hide();
		$('.error').hide();
		$('#btnLogin').attr('disabled','disabled');
		$.ajax({
			url: "ajax_admin_login",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				$('#btnLogin').removeAttr('disabled');
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
	</script>
<?php include 'footer.php'; ?>