<?php
$page_title = "Staff Members";
include 'header.php';
?>
<?php	
require_once 'includes/functions.php';			  
$query = "select * from doctors WHERE role!=1 ORDER BY docID DESC";			  
$mmm = pagination($con,substr($_SERVER['SCRIPT_NAME'],0,-4),$query,50);
?>
<h2 style="text-align:center;"><?php echo $page_title; ?> (<a href="staff">Add Staff</a>)</h2>
<?php if(!isset($_SESSION['doctorID'])) { 
die( '<div class="alert alert-danger">You are not allowed to veiw this page</div>');
}?>
<div style="display:none" class="alert alert-danger error_show"></div>
<table id="customers">
                            <thead>
                                <tr class="filters">
                                   <th>Staff ID</th>
                                    <th>Full name</th>
                                    <th>Username</th>
                                    <th>Add date</th>
                                    <th>Last Login</th>
                              <?php if(isset($_SESSION['doctorID'])) { echo '<th>Action</th>';} ?>
                                </tr>
                            </thead>
							<tbody>
                            <?php
while($v = mysqli_fetch_array($mmm))
		{
		?>
          <tr id="app<?php echo $v['docID']; ?>">
                  <td><a href="staff?id=<?php echo $v['docID']; ?>"><?php echo $v['docID']; ?></a></td>
                  <td><?php echo $v['fullname']; ?></td>
                  <td><?php echo $v['username']; ?></td>
                  <td><?php echo date('d-m-Y g:i a',$v['addDate']); ?></td>
                  <td><?php echo date('d-m-Y g:i a',$v['lastLogin']); ?></td>
		<?php if(isset($_SESSION['doctorID'])) { echo '<td><button style="color: #b94a48;background-color: #f2dede;border-color: #eed3d7;" onclick="delete_staff(this.value)" id="btnDelete" type="submit" value="'.$v['docID'].'" class="btn-danger">Delete</button></td>'; }?>
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
			function delete_staff(value){
				$('#btnDelete').attr('disabled','disabled');
	$.post("ajax_admin_delete_staff",{pid:value},function(data){
		if(data.length != 0){
			$('#btnDelete').removeAttr('disabled');
			$('.error_show').show();
			$('.error_show').html(data);
		}
	});
}
</script> 
<?php include 'footer.php'; ?>