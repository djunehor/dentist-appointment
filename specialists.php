<?php
$page_title = "Specialists";
include 'header.php';
?>
<?php	
require_once 'includes/functions.php';			  
$query = "select * from specialists ORDER BY spID DESC";			  
$mmm = pagination($con,substr($_SERVER['SCRIPT_NAME'],0,-4),$query,50);
?>
<h2 style="text-align:center;"><?php echo $page_title; ?> (<a href="specialist">Add Specialist</a>)</h2>
<?php if(!isset($_SESSION['doctorID'])) { 
die( '<div class="alert alert-danger">You are not allowed to veiw this page</div>');
}?>
<div style="display:none" class="alert alert-danger error_show"></div>
<table id="customers">
                            <thead>
                                <tr class="filters">
                                   <th>ID</th>
                                    <th>Full name</th>
                                    <th>Specialization</th>
                                    <th>Qualifications</th>
                                    <th>Photo</th>
                                    <th>Add Date</th>
                              <?php if(isset($_SESSION['doctorID'])) { echo '<th>Action</th>';} ?>
                                </tr>
                            </thead>
							<tbody>
                            <?php
while($v = mysqli_fetch_array($mmm))
		{
		?>
          <tr id="app<?php echo $v['spID']; ?>">
                  <td><a href="specialist?id=<?php echo $v['spID']; ?>"><?php echo $v['spID']; ?></a></td>
                  <td><?php echo $v['fullname']; ?></td>
                  <td><?php echo $v['spec']; ?></td>
                  <td><?php echo $v['qua']; ?></td>
                  <td><a href="<?php echo $v['photo']; ?>" target="_blank">View Photo</a></td>
                  <td><?php echo date('d-m-Y g:i a',$v['addDate']); ?></td>
		<?php if(isset($_SESSION['doctorID'])) { echo '<td><button style="color: #b94a48;background-color: #f2dede;border-color: #eed3d7;" onclick="delete_spe(this.value)" id="btnDelete" type="submit" value="'.$v['spID'].'" class="btn-danger">Delete</button></td>'; }?>
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
			function delete_spe(value){
				$('#btnDelete').attr('disabled','disabled');
	$.post("ajax_admin_delete_spec",{pid:value},function(data){
		if(data.length != 0){
			$('#btnDelete').removeAttr('disabled');
			$('.error_show').show();
			$('.error_show').html(data);
		}
	});
}
</script> 
<?php include 'footer.php'; ?>