<?php
$page_title = "Patients";
include 'header.php';
?>
<?php	
require_once 'includes/functions.php';			  
$query = "select * from patients ORDER BY clinicID DESC";			  
$mmm = pagination($con,substr($_SERVER['SCRIPT_NAME'],0,-4),$query,50);
?>
<h2 style="text-align:center;"><?php echo $page_title; ?></h2>
<?php if(!isset($_SESSION['doctorID']) && !isset($_SESSION['staffID'])) { 
die( '<div class="alert alert-danger">You are not allowed to veiw this page</div>');
}?>
<div style="display:none" class="alert alert-danger error_show"></div>
<table id="customers">
                            <thead>
                                <tr class="filters">
                                   <th>Patient ID</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>State</th>
                              <?php if(isset($_SESSION['doctorID'])) { echo '<th>Action</th>';} ?>
                                </tr>
                            </thead>
							<tbody>
                            <?php
while($v = mysqli_fetch_array($mmm))
		{
		?>
          <tr id="app<?php echo $v['aID']; ?>">
                  <td><a href="patient?id=<?php echo $v['clinicID']; ?>"><?php echo $v['clinicID']; ?></a></td>
                  <td><?php echo $v['surname']." ".$v['othernames']; ?></td>
                  <td><?php echo $v['address']; ?></td>
                  <td><?php echo $v['phone']; ?></td>
                  <td><?php echo $v['gender']; ?></td>
                  <td><?php echo $v['age']; ?></td>
                  <td><?php echo $v['state']; ?></td>
		<?php if(isset($_SESSION['doctorID'])) { echo '<td><button style="color: #b94a48;background-color: #f2dede;border-color: #eed3d7;" onclick="delete_pat(this.value)" id="btnDelete" type="submit" value="'.$v['clinicID'].'" class="btn-danger">Delete</button></td>'; }?>
                </tr>
				<?php } ?>
							</tbody>
							<tfoot>
                <tr>
                 <?php
echo $pagination; ?>
<link href="assets/css/pagination.css" rel='stylesheet' type='text/css' />
                </tr>
                </tfoot>
                          </table> 
  		<script>
			function delete_pat(value){
				$('#btnDelete').attr('disabled','disabled');
	$.post("ajax_admin_delete_patient",{pid:value},function(data){
		if(data.length != 0){
			$('#btnDelete').removeAttr('disabled');
			$('.error_show').show();
			$('.error_show').html(data);
		}
	});
}
</script> 
<?php include 'footer.php'; ?>