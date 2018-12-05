<?php
//*********written by Dushan Eranga on 1/13/2017*********//
 define('DBHOST', 'localhost');
 define('DBUSER', 'u964299551_dush');
 define('DBPASS', 'dushan@123');
 define('DBNAME', 'u964299551_dush');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }