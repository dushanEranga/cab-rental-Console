<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: default.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img style="max-width:150px; margin-top: -20px;"src="images/taxiWhite.png"></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/home.php">Home</a></li>
      <li><a href="/oldData.php">Old Receipts</a></li>
      <li><a href="/map.php">Track Vehicles </a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
  </div>
</nav>