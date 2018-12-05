<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select all data from oldData table
 $query = mysql_query("SELECT * FROM olddata"); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cab Service <?php ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
    <style>
         body {
         background-color:#FFBE2E;
         }
         .panel-default > .panel-heading {
         background: black;
         color:white;
         }
         thead {
         background-color: black;
         color: white;
         }
         tbody {
         background-color:#2F4F4F;
         color: white;
         }
         .table-hover tbody tr:hover td {
         background: grey;
         }
      </style>
</head>
<body>
<?php include_once "nav.php"; ?>
 <div id="wrapper">

 <div class="container">
    
     <div class="page-header">
     <h3>Cab Service Management</h3>
     </div>
        
        <div class="row">
        <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">List of Old Data</div>
				
				<div class="panel-body">
					 
							 <table class="table table-hover">
							 <thead>
								<tr>
									<td>Customer ID</td>
									<td>Date Borrowd</td>
									<td>Name</td>
									<td>Address</td>
									<td>Telephone</td>
									<td>NIC</td>
									<td>Vehicle ID</td>
									<td>Distance</td>
									<td>Damages</td>
									<td>Returened Day</td>
									<td>Payment</td>
									<td>Print Bill</td>
									
								</tr>
							</thead>
							<tbody>
							<!--need to find out what is happening here-->
								<?php
								   while ($row = mysql_fetch_array($query)) { 
								?>
									  <tr>
									<td><?php echo $row[cusId]; ?></td>
									<td><?php echo $row[dateTime]; ?></td>
									<td><?php echo $row[name]; ?></td>
									<td><?php echo $row[address]; ?></td>
									<td><?php echo $row[tp]; ?></td>
									<td><?php echo $row[nic]; ?></td>
									<td><?php echo $row[vehicleId]; ?></td>
									<td><?php echo $row[kms]; ?></td>
									<td><?php echo $row[damages]; ?></td>
									<td><?php echo $row[returnedDay]; ?></td>
									<td><?php echo $row[payment]; ?></td>
									<td><a href="bill.php" class="btn btn-default" role="button">Print</a></td>
									
									
								</tr>
								<?php
								   }

								?>
								</tbody>
							</table		

				</div>
			</div>
		
        </div>
        </div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>