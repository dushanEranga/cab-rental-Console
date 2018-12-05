<?php
	require_once 'dbconnect.php';
	$query1 = mysql_query("UPDATE customer SET vehicleId = '" . $_GET['id'] . "'  WHERE cusId LIKE  '" . $_GET['cusId'] . "'  ") or die(mysql_error());
	$query2 = mysql_query("INSERT INTO hired (vehicleID , vehicle , type , seats) SELECT * FROM  available where vehicleId = '" . $_GET['id'] . "'") or die(mysql_error());
	$query3 = mysql_query("DELETE FROM available WHERE vehicleId ='" . $_GET['id'] . "' ") or die(mysql_error());
	$query4 = mysql_query("UPDATE markers SET kms = '0' WHERE vehicleId = '1' ") or die("$query4-".mysql_error());

	
	if ($query1 ==1 && $query2 ==1 && $query3 ==1 && $query4 ==1 ) {
		header("location:home.php");
		exit();
	}
	
?>