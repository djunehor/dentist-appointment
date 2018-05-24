<?php
$page_title = "Patient List";
include '../views/admin_header.php'; 
?>
                    <!-- panel start -->
                    <div class="panel panel-primary filterable">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
					                       <?php				
			  require_once '../includes/functions.php';			  
$query = "select * from patients ORDER BY clinicID DESC";			  
$mmm = pagination($con,substr($_SERVER['SCRIPT_NAME'],0,-4),$query,50);
?>
                        <h3 class="panel-title">Appointment List</h3>
                        <div class="pull-right">
       
                        </div>
                        </div>
                        <div class="panel-body">
                        <!-- Table -->
						<div class="alert alert-danger error_show" style="display:none"></div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th>Patient ID</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
							<tbody>
                            <?php
while($v = mysqli_fetch_array($mmm))
		{
		?>
                <tr id="app<?php echo $v['aID']; ?>">
                  <td><?php echo $v['clinicID']; ?></td>
                  <td><?php echo $v['fullname']; ?></td>
                  <td><?php echo $v['address']; ?></td>
                  <td><?php echo $v['phone']; ?></td>
                  <td><?php echo $v['gender']; ?></td>
                  <td><button onclick="delete_pat(this.value)" id="btnDelete" type="submit" value="<?php echo $v['aID']; ?>" class="btn btn-danger">Delete</button></td>
                  <td><a href="patient?id=<?php echo $v['clinicID']; ?>" class="btn btn-info">Edit</a></td>
                </tr>
				<?php } ?>
							</tbody>
							<tfoot>
                <tr>
                 <?php
echo $pagination; ?>
<link href="../assets/css/pagination.css" rel='stylesheet' type='text/css' />
                </tr>
                </tfoot>
                          </table> 
                    </div>
                </div>
                    <!-- panel end -->
					<script>
			function delete_pat(value){
				$('#btnDelete').attr('disabled','disabled');
	$.post("ajax_admin_delete",{pid:value},function(data){
		if(data.length != 0){
			$('#btnDelete').removeAttr('disabled');
			$('.error_show').show();
			$('.error_show').html(data);
		}
	});
}
</script> 
<?php include '../views/admin_footer.php'; ?>