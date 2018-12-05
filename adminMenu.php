

<?php
   ob_start();
   session_start();
   require_once 'dbconnect.php';
   
   // if session is not set this will redirect to login page
   if( !isset($_SESSION['user']) ) {
    header("Location: default.php");
    exit;
   }
   // select loggedin username
   $res=mysql_query("SELECT userName FROM users WHERE userId=".$_SESSION['user']);
   $userRow=mysql_fetch_array($res);
   
   if($userRow['userName'] != "admin"){
   header("Location: default.php");
   exit; 
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>welcome admin console <?php ?></title>
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
         .my-tab .tab-pane{ border:solid 1px blue;  border-top: 0;    }
      </style>
   </head>
   <body>
      <br>
      <br>
      <div id="wrapper">
         <div class="col-lg-6">
            <a href="register.php" <button type="button" class="btn btn-success btn-lg btn-block">Add User Accounts</button></a>
            <a href="viewUsers.php"  <button type="button" class="btn btn-success btn-lg btn-block">View User Accounts</button></a>
         </div>
         <div class="col-lg-6">
            <a href="#"  <button type="button" class="btn btn-success btn-lg btn-block">Add a new vehicle</button></a>
            <a href="vehiList.php"  <button type="button" class="btn btn-success btn-lg btn-block">Update vehicles</button></a>
         </div>
      </div>
   </body>
</html>
<?php ob_end_flush(); ?>

