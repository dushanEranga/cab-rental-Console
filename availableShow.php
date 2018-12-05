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
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
 // select all from available table
 $query = mysql_query("SELECT * FROM available"); 
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
        <div class="col">
			<div class="panel panel-default">
				<div class="panel-heading">List of available vehicles</div>
				<div class="panel-body">
							 <table class="table table-hover">
							 <thead>
								<tr>
									<td>Vehicle-ID</td>
									<td>Vehicle</td>
									<td>Type</td>
									<td>Seats</td>
									<td></td>
								</tr>
							</thead>
								<?php
								   while ($row = mysql_fetch_array($query)) { 
								?>
								<tbody>
									<tr>
									<td><?php echo $row[vehicleId]; ?></td>
									<td><?php echo $row[vehicle]; ?></td>
									<td><?php echo $row[type]; ?></td>
									<td><?php echo $row[seats]; ?></td>
									<td> <a class="btn btn-default" href="customerList.php?id=<?php echo $row[vehicleId] ?> " role="button">Rent it out</a></td>
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

</body>
</html>
<?php ob_end_flush(); ?>