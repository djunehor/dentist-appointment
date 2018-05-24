<?php
$page_title = "Patient";
include '../views/admin_header.php'; 
if(isset($_GET['id'])) {
	$id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
	$user = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM patients WHERE clinicID='$id'"));
}
?>


                    <!-- panel start -->
                    <div class="panel panel-primary filterable">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Patient</h3>
                            <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                           <!-- Table -->
						   <div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<div class="description">
									<h4>Edit Patient</h4>
									<form id="patient_update" role="form">
													<td><input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required=""/></td>
												</tr>
												<br>
												<br>
												<tr>
													<td><input type="tel" name="phone" value="<?php echo $user['phone']; ?>" required=""/></td>
												</tr>
												<br>
												<br>
												<tr>
													<td><textarea type="text" name="address" required=""><?php echo $user['address']; ?></textarea></td>
												</tr>
												<br>
												<br>
												<tr>
													<td>Gender</td>
													<td><input type="radio" name="gender" value="male" <?php if($user['gender']=='male') {echo 'checked';} ?>>Male <input type="radio" name="gender" value="female" <?php if($user['gender']=='female') {echo 'checked';} ?>>Female 
											
													</td>
												</tr>
												<br>
												<br>
									<button type="button" id="btnPatientUpdate" class="btn btn-primary" >Update Profile</button>
									</form>
								<!--	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>  -->
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<h3> Add Patient </h3>
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" align="center">
											<tbody>
												
												
												<tr>
													<td>Full Name</td>
													<td><input type="text" name="fullname" required=""/></td>
												</tr>
												<tr>
													<td>Phone</td>
													<td><input type="tel" name="phone" required=""/></td>
												</tr>
												<tr>
													<td>Address</td>
													<td><input type="text" name="address" required=""/></td>
												</tr>
												<tr>
													<td>Gender</td>
													<td><input type="radio" name="gender" value="male">Male <input type="radio" name="gender" value="female">Female 
											
													</td>
												</tr>
											</tbody>
										</table>
									<button type="button" id="btnPatientAdd" class="btn btn-primary" >Add Patient</button>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
						
					</div>
                       
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                    </div>
                 <?php include '../views/admin_footer.php'; ?>