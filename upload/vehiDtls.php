

<?php
   ob_start();
   session_start();
   require_once '../dbconnect.php';
   
   // if session is not set this will redirect to login page
   if (!isset($_SESSION['user'])) {
       header("Location: ../default.php");
       exit;
   }
   // select loggedin users detail
   $res1     = mysql_query("SELECT userName FROM users WHERE userId=" . $_SESSION['user']);
   $userRow = mysql_fetch_array($res1);
    if($userRow['userName'] != "admin"){
   	header("Location: default.php");
   	exit; 
    }
   
   $res2     = mysql_query("SELECT vehicle,type,rent,repair,photo,vehicleNumber FROM markers WHERE vehicleId = '" . $_GET["id"] . "' ")  or die(mysql_error());
   while ($row = mysql_fetch_array($res2)) {	
   		$vehicle = $row[vehicle];
   		$type = $row[type];
   		$rent = $row[rent];
   		$repair = $row[repair];
   		$photo = $row[photo];
   		$vehicleNumber = $row[vehicleNumber];
   	}
   
   //--------------------------------------------------------------------------------------------
   $error   = false;
   
   if (isset($_POST['vehiDtls'])) {
       $vehicle = $_POST['vehicle'];
       $rent    = $_POST['rent'];
       $repair  = $_POST['repair'];
   	   $type	 = $_POST['type'];
       
       // basic vehicle name validation
       if (empty($vehicle)) {
           $error        = true;
           $vehicleError = "Please enter the vehicle name.";
       } else if (strlen($vehicle) < 1) {
           $error        = true;
           $vehicleError = "vehicle name must have atleat 1 character.";
       }
   	
       // basic type validation
       if (empty($type)) {
           $error        = true;
           $typeError = "Please enter the vehicle name.";
       } else if (strlen($type) < 1) {
           $error        = true;
           $typeError = "vehicle name must have atleat 1 character.";
       }
       
       // basic rent validation
       if (empty($rent)) {
           $error     = true;
           $rentError = "Please enter the amount per day.";
       } else if (strlen($rent) < 2) {
           $error     = true;
           $rentError = "enter a valid amount.";
       }
       
       // basic details validation
       if (empty($repair)) {
           $error        = true;
           $repairError = "Please enter the details of vehicle.";
       } else if (strlen($repair) < 5) {
           $error        = true;
           $repairError = "vehicle details  must have atleat 5 characters.";
       }
       //upload image validation
   	
   	$uploadOk = 0;
   if($_FILES['fileToUpload']['name'] != '') {
       $target_dir  = getcwd() . DIRECTORY_SEPARATOR;
       $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
       
       $uploadOk = 1;
       
       $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
       $rename_file   = $target_dir . $vehicle . "." . $imageFileType;
       $unlink_dir    = $target_dir . $vehicle;
       // Check if image file is a actual image or fake image
       if (isset($_POST["vehiDtls"])) {
           $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
           if ($check !== false) {
               //$error = true;
               //$imageError =  "File is an image - " . $check["mime"] . ".";
               $uploadOk = 1;
           } else {
               $error      = true;
               $imageError = "File is not an image.";
               $uploadOk   = 0;
           }
       }
       
       // Check file size
       if ($_FILES["fileToUpload"]["size"] > 10485760 ) { //10mb
           $error      = true;
           $imageError = "Sorry, your file is too large.";
           $uploadOk   = 0;
       }
       // Allow certain file formats
       if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
           $error      = true;
           $imageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
           $uploadOk   = 0;
       }
       // Check if $uploadOk is set to 0 by an error
       if ($uploadOk == 0) {
           $error      = true;
           //$imageError = "Sorry, your file was not uploaded.";   
       }	
   }
       // if everything is ok, try to upload file and update query
       if (!$error) {
           $query1 = mysql_query("UPDATE markers SET vehicle = '" . $_POST["vehicle"] . "' , type ='" . $_POST["type"] . "' ,  rent ='" . $_POST["rent"] . "'  , repair ='" . $_POST["repair"] . "'  WHERE vehicleId LIKE  '" . $_GET["id"] . "'  ") or die("Failled in insert--" . mysql_error());
           $img	=	$_POST["vehicle"].".".$imageFileType;
   		
   		if ($uploadOk == 1){
   			$query2 = mysql_query("UPDATE markers SET photo ='$img' WHERE vehicleId LIKE  '" . $_GET["id"] . "'  ") or die("Failled in insert--" . mysql_error());
   			$file = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $rename_file);
   		}
           
           if ($query1 && $uploadOk) {
               $errTyp = "success";
               $errMSG = "Successfully updated." ."<br>";
   			$errMSG2 = basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
           }else if($query1 && $uploadOk==0){
   			$errTyp = "success";
               $errMSG = "Successfully updated." ."<br>";
   			$errMSG2 = "Image Not Updated." ."<br>";
   		}
       }
   	 else {
   		$errTyp = "danger";
   		$errMSG = "Something went wrong, try again later...";
   	}
   }
   ?> 
<!DOCTYPE html>
<html>
   <head>
      <title>Cab Service
         <?php ?>
      </title>
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
         .input-group-addon.success {
         color: rgb(255, 255, 255);
         background-color: black;
         border-color: rgb(76, 174, 76);
         }
      </style>
   </head>
   <body>
      <?php echo $row[cusID]; ?>
      <?php include_once "../nav.php"; ?>
      <div class="col-md-12 text-center">
         <img style="max-width:400px; margin-top: -10px; margin-bottom: -10px;" src="../images/taxi.png">
      </div>
      <div id="wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-13">
                  <div class="container">
                     <div id="login-form">
                        <form method="post" action="" enctype="multipart/form-data">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <h2 class="">Edit Details <b><?php echo $vehicle;?> (Vehicle Number: <?php echo $vehicleNumber;?>)</b></h2>
                              </div>
                              <div class="form-group">
                                 <hr />
                              </div>
                              <?php
                                 if ( isset($errMSG) ) {
                                  
                                 ?>
                              <div class="form-group">
                                 <div class="alert alert-<?php echo ($errTyp=="success") ? "info" : $errTyp; ?>">
                                    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG;?>
                                    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG2;?>
                                 </div>
                              </div>
                              <?php
                                 }
                                 ?>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon success"><span class="glyphicon glyphicon-plane"></span>&nbsp;&nbsp;&nbsp;Vehicle&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="text" name="vehicle" class="form-control" placeholder="Enter vehicle name" maxlength="50" value="<?php echo $vehicle ?>" />
                                 </div>
                                 <span class="text-danger"><?php echo $vehicleError; ?></span>
                              </div>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon success"><span class="glyphicon glyphicon-plane"></span>&nbsp;&nbsp;&nbsp;Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="text" name="type" class="form-control" placeholder="Enter type of vehicle" maxlength="50" value="<?php echo $type ?>" />
                                 </div>
                                 <span class="text-danger"><?php echo $typeError; ?></span>
                              </div>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon success"><span class="glyphicon glyphicon-euro"></span>&nbsp;&nbsp;&nbsp;Rent(per day)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="text" name="rent" class="form-control" placeholder="Enter Rate Here" value="<?php echo $rent ?>" />
                                 </div>
                                 <span class="text-danger"><?php echo $rentError; ?></span>
                              </div>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon success"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;&nbsp;Recent Repair Details</span>
                                    <textarea rows="4" name="repair" class="form-control" placeholder="Enter Details Here" value="<?php echo $repair ?>"><?php echo $repair ?></textarea>
                                 </div>
                                 <span class="text-danger"><?php echo $repairError; ?></span>
                              </div>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon success"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;&nbsp;Add A Photo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    &nbsp;&nbsp;<input type="hidden" class="btn btn-default btn-file" name="size" value="350000"> &nbsp;&nbsp;
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                 </div>
                                 <span class="text-danger"><?php echo $imageError; ?></span>
                              </div>
                              <div class="form-group">
                                 <hr />
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-block btn-success" name="vehiDtls">Save Changes</button>
                              </div>
                              <div class="form-group">
                                 <hr />
                              </div>
                           </div>
                        </form>
                        <a href="../vehiList.php"><button  class="btn btn-lg btn-primary" name="vehiDtls">Back To List</button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
<?php ob_end_flush(); ?>

