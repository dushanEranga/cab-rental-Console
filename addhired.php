<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page

if (!isset($_SESSION['user']))
	{
	header("Location: default.php");
	exit;
	}

$cus = mysql_query("SELECT * FROM customer WHERE cusId =" . $_GET['cusId']);
$row1 = mysql_fetch_array($cus);

$vehi = mysql_query("SELECT * FROM available WHERE vehicleId =" . $_GET['id']);
$row2 = mysql_fetch_array($vehi);

$marker = mysql_query("SELECT repair,vehicleNumber FROM markers WHERE vehicleId =" . $_GET['id']);
$row3 = mysql_fetch_array($marker);
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
      </style>
      <script>
        function goBack() {
            window.history.back();
        }
      </script>
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
                     <div class="panel-heading">Select the service</div>
                     <div class="panel-body center-text">
                        <h3>Transaction details</h3>
                        <img style="max-width:800px;"src="upload/<?php echo $row2['vehicle'];?>.jpg" class="img-responsive center-block">
                        <h4><b> Vehicle:</b> <?php echo $row2['vehicle'];?>(<?php echo $row3['vehicleNumber'];?> )</h4>
                        <h4><b> Customer:</b> <?php echo $row1['name'];?></h4>
                        <h4><b> Recent Repairs:</b>  <?php echo $row3['repair'];?></h4>
                        <a href="confirmhiring.php?id=<?php echo $row2['vehicleId'];?>&cusId=<?php echo $row1['cusId'];?>" <button type="button" class="btn btn-success btn-lg btn-block">Confirm Vehicle</button></a>
                        <a href="#" <button type="button" class="btn btn-success btn-lg btn-block" onclick="goBack()">Back to vehicle list</button></a>
                        <a href="#" <button type="button" class="btn btn-warning btn-lg btn-block">Cancel</button></a>			
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
<?php ob_end_flush(); ?>

