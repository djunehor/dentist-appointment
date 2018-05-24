<?php
include '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Doctor | <?php echo $website_name; ?></title>
        <!-- Bootstrap -->
        <link href="../admin-assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../admin-assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
		<h2 style="text-align:center;">DOCTOR LOGIN</h2>
            <!-- start -->
            <div class="login-container">
                    <div id="output">				
					<div style="display:none" class="alert alert-success success1"></div>
													<div style="display:none" class="alert alert-info loading1">Loading...</div>
													<div style="display:none" class="alert alert-danger error1"></div>
					</div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form class="form" role="form" id="admin_login" accept-charset="UTF-8">
                            <input name="username" type="text" placeholder="Doctor ID" required>
                            <input name="password" type="password" placeholder="Password" required>
                            <button class="btn btn-info btn-block login" id="btnAdminLogin" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            <!-- end -->
        </div>

        <script src="../admin-assets/js/jquery.js"></script>
<script>
$(document).ready(function (e) {
	$("#admin_login").on('submit',(function(e) {
		e.preventDefault();
		$('.loading1').show();
		$('.success1').hide();
		$('.error1').hide();
		$('#btnAdminLogin').attr('disabled','disabled');
		$.ajax({
			url: "ajax_admin_login",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				$('#btnAdminLogin').removeAttr('disabled');
				$('.loading1').hide();
				
				if(data.search("Error")!=-1){
					$('.error1').show();
					$('.success1').hide();
					$('.error1').html(data);
				}
				else{
					$('.success1').show();
					$('.error1').hide();
					$('.success1').html(data);
				}
			}
		});
	}));
});
</script>
        <!-- js start -->
        
        <!-- js end -->
    </body>
</html>