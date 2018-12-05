

<?php
   ob_start();
   session_start();
   require_once 'dbconnect.php';
   
   // if session is not set this will redirect to login page
   if( !isset($_SESSION['user']) ) {
    header("Location: default.php");
    exit;
   }
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
   </head>
   <body>
      <br>
      <br>
      <div id="wrapper">
         <a href="cus-reg.php" <button type="button" class="btn btn-success btn-lg btn-block">Proceed with customer details</button></a>
         <a href="hired-vehicles.php" <button type="button" class="btn btn-success btn-lg btn-block">Hired Vehicles</button></a>
         <a href="availableShow.php" <button type="button" class="btn btn-success btn-lg btn-block">Available Vehicles</button></a>
      </div>
   </body>
</html>
<?php ob_end_flush(); ?>

