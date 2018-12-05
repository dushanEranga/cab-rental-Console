<?php print_r($_GET); ?>
<?php
	 require_once 'dbconnect.php'; 
	
	$query1 = mysql_query("INSERT INTO available (vehicleID , vehicle , type , seats) SELECT * FROM  hired where vehicleId = '" . $_GET['id'] . "'") or die("$query1-".mysql_error());
	$query2 = mysql_query("DELETE FROM hired WHERE vehicleId ='" . $_GET['id'] . "' ") or die("$query2-".mysql_error());
	
	$query3 = mysql_query("INSERT INTO olddata values ('','','','','','','" . $_GET['id'] . "','','','','','')") or die("$query3-".mysql_error());
	
	$query4 = mysql_query("UPDATE olddata o
							INNER JOIN customer c ON (o.vehicleId=c.vehicleId)
							SET 
							o.cusId = c.cusId ,
							o.name = c.name ,
							o.address = c.address ,
							o.tp = c.tp ,
							o.nic = c.nic ,
							o.dateTime = c.dateTime
							WHERE o.vehicleId = c.vehicleId") or die("$query4-".mysql_error());
	
	$query5 = mysql_query("UPDATE olddata o
							INNER JOIN markers m ON (o.vehicleId=m.vehicleId)
							SET 
							o.kms = m.kms ,
							o.returnedDay = m.timeStamp
							WHERE o.vehicleId = m.vehicleId") or die("$query5-".mysql_error());
	
	$query6 = mysql_query("UPDATE olddata o
							INNER JOIN hired h ON (o.vehicleId=h.vehicleId)
							SET 
							o.vehicle = h.vehicle
							WHERE o.vehicleId = h.vehicleId") or die("$query6-".mysql_error());
	
	
	$query7 = mysql_query("DELETE FROM customer WHERE vehicleId ='" . $_GET['id'] . "' ") or die("$query7-".mysql_error());
	
	$query8 = mysql_query("UPDATE markers SET kms = 0 WHERE vehicleId = 1 ") or die("$query8-".mysql_error());
	
	///////////////////////////////////////////////////////please reset the meeter
	
	if ($query1 ==1 && $query2 ==1) {
		header("location:availableShow.php");
		exit();
	}
	
?>

