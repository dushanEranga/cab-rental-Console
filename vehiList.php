<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT userName FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
  if($userRow['userName'] != "admin"){
	header("Location: index.php");
	exit; 
 }
 //select all from avilable vehicle table
 $query = mysql_query("SELECT vehicleId,vehicle,type,rent,repair,photo FROM markers"); 
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
				<div class="panel-heading">List of registered vehicles</div>
				
				<div class="panel panel-default">
							 <table class="table table-bordered">
							 <thead>
								<tr>
									<td>Photo</td>
									<td>Vehicle-ID</td>
									<td>Vehicle</td>
									<td>Type</td>
									<td>Seats</td>
									<td>Renting value(per day)</td>
									<td>Recent Rapairs</td>
									<td>Update vehicles</td>
								</tr>
							</thead>
							<!--need to find out what is happening here-->
								<?php
								   while ($row = mysql_fetch_array($query)) { 
								?>
								<tr>
									<td><img src="upload/<?php echo $row[photo];?>" alt="<?php echo $row[photo];?>" width="100" height="100"></td>
									<td><?php echo $row[vehicleId]; ?></td>
									<td><?php echo $row[vehicle]; ?></td>
									<td><?php echo $row[type]; ?></td>
									<td><?php //echo $row[seats]; ?></td>
									<td><?php echo $row[rent]; ?></td>
									<td><?php echo $row[repair]; ?></td>
									<td><a class="btn btn-default" href="upload/vehiDtls.php?id=<?php echo $row[vehicleId] ?>" role="button">Update</a></td>
								</tr>
								<?php
								   }
								?>
							</table>	
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