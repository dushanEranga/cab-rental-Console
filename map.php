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
<!DOCTYPE html >
  <head>
	<title>Map <?php ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>PHP/MySQL & Google Maps Example</title>
    <script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyADDkUn12QrPUUrLwTCraTVmCWe7jmgajs"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      hatchback: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      van: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
     },
      suv: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_green.png'
      },
      station_wagon: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_yellow.png'
      },
      Heavy_Duty: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_black.png'
      }
      

    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(7.923796, 80.616524),
        zoom: 8,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("configmap_xml.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var vehicleId = markers[i].getAttribute("vehicleId");
          var vehicle = markers[i].getAttribute("vehicle");
		  var kms = markers[i].getAttribute("kms");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" +"Vehicle ID: "+ vehicleId + "</b> <br/>" +"Vehicle is: "+ vehicle + "</b> <br/>"+ kms+" Km done";
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
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

  <body onload="load()">
  <?php include_once "nav.php"; ?>

 <div id="wrapper">

 <div class="container">
    
     <div class="page-header">
     <h3>Cab Service Management</h3>
     </div>
        
        <div class="row">
        <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Positions of vehicles</div>
				
				<div class="panel-body">
					<div id="map" style="width: 1100px; height: 700px"></div>
				</div>
			</div>
		
        </div>
        </div>
    
    </div>
    
    </div>
    
</body>
</html>
<?php ob_end_flush(); ?>