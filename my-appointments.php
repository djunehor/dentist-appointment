<?php
$page_title = "My Appointments";
include 'header.php';
?>
<style>
table#customers {
    font-size:16px;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    text-align: left;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2}

#customers th {
    padding-top: 11px;
    padding-bottom: 11px;
    background-color: #4CAF50;
    color: white;
}
.tabletest {
  margin-top: 20px;
  margin-bottom: 40px;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

.tabletest,
.tabletest th,
.tabletest td {
  padding: 8px;
  text-align: left;
}

.tabletest2 {
  font-size:15px;
  margin-top: 20px;
  margin-bottom: 40px;
  border-collapse: collapse;
  width: 100%;
}

.tabletest2,
.tabletest2 th,
.tabletest2 td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.tabletest3 {
  border: 1px solid #ddd;
  margin-top: 20px;
  margin-bottom: 40px;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

.tabletest3,
.tabletest3 th,
.tabletest3 td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.tabletest4 {
  margin-top: 20px;
  margin-bottom: 40px;
  border-collapse: collapse;
  width: 100%;
}

.tabletest4,
.tabletest4 th,
.tabletest4 td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.tabletest4 tr:hover {
  background-color: #f5f5f5
}

.tabler2 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
  margin-top: 20px;
  margin-bottom: 40px;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

.tabler2,
.tabler2 th,
.tabler2 td {
  border: none;
  text-align: left;
  padding: 8px;
}

.tabler2 tbody tr:nth-child(even) {
  background-color: #f2f2f2
}

.tabler {
  margin-top: 20px;
  margin-bottom: 40px;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

.tabler,
.tabler th,
.tabler td {
  border: none;
  text-align: left;
  padding: 8px;
}

.tabler tbody tr:nth-child(even) {
  background-color: #f2f2f2
}

</style>
<?php	
error_reporting(E_ALL);	
require_once 'includes/functions.php';			  
$query = "select * from appointments a WHERE clinicID='".$_SESSION['clinicID']."' ORDER BY aID DESC";			  
$mmm = pagination($con,substr($_SERVER['SCRIPT_NAME'],0,-4),$query,50);
?>
<h2 style="text-align:center;"><?php echo $page_title; ?></h2>
<table id="customers">
                            <thead>
                                <tr class="filters">
                                    <th>Symptom/Comment</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
							<tbody>
                            <?php
while($v = mysqli_fetch_array($mmm))
		{
		?>
                <tr id="app<?php echo $v['aID']; ?>">
                  <td><?php echo $v['symptom']; ?></td>
                  <td><?php echo $v['apDate']; ?></td>
                  <td><?php echo $v['apTime']; ?></td>
                  <td><?php if($v['status']==0) {echo 'Pending';} elseif($v['status']==1) {echo 'Passed';} elseif($v['status']==2) {echo 'Cancelled';} else{echo '-';} ?></td>
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
  
<?php include 'footer.php'; ?>