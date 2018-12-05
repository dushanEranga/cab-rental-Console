<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: default.php");
  exit;
 }
 
 //select all from avilable vehicle table
 $query = mysql_query("SELECT userName,userEmail FROM users"); 
 
 
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
				
				<div class="panel-body">
							 <table class="table table-bordered">
							 <thead>
								<tr>
									<td>User Name</td>
									<td>User Email</td>
									<td>Delete Account</td>
								</tr>
							</thead>
							<!--need to find out what is happening here-->
								<?php
								   while ($row = mysql_fetch_array($query)) { 
								?>
								<tr>
									<td><?php echo $row[userName]; ?></td>
									<td><?php echo $row[userEmail]; ?></td>
									<td><a class="btn btn-default" href=# class="btn btn-default" <?php if($row[userName]=="admin") echo "disabled=\"disabled\" " ;?> role="button" >Delete</a></td>
									
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