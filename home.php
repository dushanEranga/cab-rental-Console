

<?php
   ob_start();
   session_start();
   require_once 'dbconnect.php';
   
   // if session is not set this will redirect to login page
   if (!isset($_SESSION['user'])) {
   	header("Location: default.php");
   	exit;
   }
   
   // select logged in users detail
   $res = mysql_query("SELECT * FROM users WHERE userId=" . $_SESSION['user']);
   $userRow = mysql_fetch_array($res);
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>welcome <?php ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style>
         body {
         background-color: #FFBE2E;
         }
         .panel-default > .panel-heading {
         background: black;
         }
         .panel-heading {
         color: white;
         }
         .nav-tabs{
         background-color:#161616;
         padding-right: 14px;
         }
         .nav-tabs > li > a{
         border: medium none;
         color : white;
         }
         .nav-tabs > li > a:hover{
         background-color: #303136 !important;
         border: medium none;
         border-radius: 0;
         color:#fff;
         }
      </style>
   </head>
   <body>
      <?php include_once "nav.php"; ?>
      <br>
      <br>
      <br>
      <div id="wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <ul class="nav nav-tabs" role="tablist">
                           <li role="presentation" class="active">
                              <a data-toggle="tab" href="#home">
                                 Cab Service  
                                 <svg-icon>
                                 <src href="svg/si-glyph-bed.svg"/>
                                 </svg> 
                              </a>
                           </li>
                           <li role="presentation"><a data-toggle="tab" href="#menu1">Taxi Service</a></li>
                           <li role="presentation"><a data-toggle="tab" href="#menu2">Admin Panel</a></li>
                        </ul>
                     </div>
                     <div class="panel-body">
                        <div class="tab-content">
                           <div id="home" class="tab-pane fade in active">
                              <?php include_once "cab.php"; ?>
                           </div>
                           <div id="menu1" class="tab-pane fade">
                              <h3>Page under construction</h3>
                           </div>
                           <div id="menu2" class="tab-pane fade">
                              <?php if($userRow['userName'] == "admin"){ include_once("adminMenu.php"); } 
                                 else {
                                    echo "<h3> Please login through an admin account to access the administrative priviledges </h3>";
                                    echo "<br>";
                                    echo '<h3> Login from here </h3><a href="logout.php?logout" <button type="button" class="btn btn-info">LOGIN</button></a>';
                                     
                                    }
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
<?php ob_end_flush(); ?>

