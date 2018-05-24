<?php
$page_title = "Appointments";
include '../views/admin_header.php'; 
?>
                    <!-- panel start -->
                    <div class="panel panel-primary filterable">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
					                       <?php				
			  require_once '../includes/functions.php';			  
$query = "select * from appointments a INNER JOIN patients p ON a.clinicID=p.clinicID ORDER BY aID DESC";			  
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
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                  <td><?php echo $v['apDate']; ?></td>
                  <td><?php echo $v['apTime']; ?></td>
                  <td><?php if($v['status']==0) {echo 'Pending';} elseif($v['status']==1) {echo 'Passed';} elseif($v['status']==2) {echo 'Cancelled';} else{echo '-';} ?></td>
                  <td><button onclick="cancel_app(this.value)" id="btnCancel" type="submit" <?php if($v['status']==2) {echo 'disabled';} ?> value="<?php echo $v['aID']; ?>" class="btn btn-danger">Cancel</button></td>
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
			function cancel_app(value){
				$('#btnCancel').attr('disabled','disabled');
	$.post("ajax_admin_cancel",{pid:value},function(data){
		if(data.length != 0){
			$('#btnCancel').removeAttr('disabled');
			$('.error_show').show();
			$('.error_show').html(data);
		}
	});
}
</script> 
<?php include '../views/admin_footer.php'; ?>