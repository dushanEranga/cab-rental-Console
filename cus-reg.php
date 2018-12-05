<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page

if (!isset($_SESSION['user']))
	{
	header("Location: index.php");
	exit;
	}

// select loggedin users detail

$res = mysql_query("SELECT * FROM users WHERE userId=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);
$error = false;

if (isset($_POST['cus-reg']))
	{

	// clean user inputs to prevent sql injections

	$name = trim($_POST['name']);
	$name = strip_tags($name);
	$name = htmlspecialchars($name);
	$address = trim($_POST['address']);
	$address = strip_tags($address);
	$address = htmlspecialchars($address);
	$nic = trim($_POST['nic']);
	$nic = strip_tags($nic);
	$nic = htmlspecialchars($nic);
	$tp = trim($_POST['tp']);
	$tp = strip_tags($tp);
	$tp = htmlspecialchars($tp);

	// basic name validation

	if (empty($name))
		{
		$error = true;
		$nameError = "Please enter your full name.";
		}
	  else
	if (strlen($name) < 3)
		{
		$error = true;
		$nameError = "Name must have atleat 3 characters.";
		}
	  else
	if (!preg_match("/^[a-zA-Z ]+$/", $name))
		{
		$error = true;
		$nameError = "Name must contain alphabets and space.";
		}

	// basic address validation

	if (empty($address))
		{
		$error = true;
		$addressError = "Please enter the address.";
		}
	  else
	if (strlen($address) < 3)
		{
		$error = true;
		$addressError = "Address Should be address.";
		}

	// basic nic validation

	$nic_9 = substr($nic, 0, 9);
	$nic_v = substr($nic, 9, 1);
	if (empty($nic))
		{
		$error = true;
		$nicError = "Please enter the NIC Number.";
		}
	  else
	if (strlen($nic) < 10)
		{
		$error = true;
		$nicError = "NIC Should be a NIC number.";
		}
	  else
	if (!is_numeric($nic_9))
		{
		$error = true;
		$nicError = "NIC Should have  a NIC number.";
		}
	  else
	if (!($nic_v == 'v' || $nic_v == 'V'))
		{
		$error = true;
		$nicError = "NIC Should have letter V at last.";
		}

	// tp validation

	if (empty($tp))
		{
		$error = true;
		$tpError = "Please enter Telepphone Number.";
		}
	  else
	if (strlen($tp) < 10)
		{
		$error = true;
		$tpError = "Telephone Number must have  10 characters.";
		}
	  else
	if (!ctype_digit($tp))
		{
		$error = true;
		$tpError = "Telephone Should have only numbers.";
		}

	// if there's no error, continue to register

	if (!$error)
		{
		$query1 = mysql_query("INSERT INTO  customer  VALUES ( '',NOW(),'$name','$address','$nic','$tp','')") or die("Failled in insert--" . mysql_error());
		if ($query1)
			{
			$errTyp = "success";
			$errMSG = "Successfully registered,";
			unset($name);
			unset($address);
			unset($tp);
			$query2 = mysql_query("SELECT cusId FROM customer WHERE nic LIKE '$nic' ") or die(mysql_error());

			// mysql_real_escape_string($prefix));

			$row = mysql_fetch_array($query2);
			header("location:available-cars.php?cusId=$row[cusId]");
			unset($nic);
			}
		}
	}
  else
	{
	$errTyp = "danger";
	$errMSG = "Something went wrong, try again later...";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
    <style>
      body {
        background-color:#FFBE2E;
      }
    </style>
    </style>
  </head>
  
<body>
  <?php include_once "nav.php"; ?>
  <?php echo $row[cusID]; ?>
  <div class="col-md-12 text-center">
    <img style="max-width:400px; margin-top: 10px; margin-bottom: 5px;"src="images/taxi.png">  
  </div>
          <div class="container">
              <div class="col-md-12">
              <form method="post" action="" >
                  <div class="form-group">
                    <h2 class=""> Customer Register </h2>
                  </div>
                  
                  <div class="form-group">
                    <hr />
                  </div>

                  <?php
if ( isset($errMSG) ) {
?>
                  <?php
}
?>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-user">
                        </span>
                      </span>
                      <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
                    </div>
                    <span class="text-danger">
                      <?php echo $nameError; ?>
                    </span>
                  </div>
                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-home">
                        </span>
                      </span>
                      <input type="text" name="address" class="form-control" placeholder="Enter Address Here"  value="<?php echo $address ?>" />
                    </div>
                    <span class="text-danger">
                      <?php echo $addressError; ?>
                    </span>
                  </div>
                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-barcode">
                        </span>
                      </span>
                      <input type="text" name="nic" class="form-control" placeholder="Enter NIC here" maxlength="10" value="<?php echo $nic ?>" />
                    </div>
                    <span class="text-danger">
                      <?php echo $nicError; ?>
                    </span>
                  </div>
                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-phone-alt">
                        </span>
                      </span>
                      <input type="text" name="tp" class="form-control" placeholder="Enter telephone number here" maxlength="10" value="<?php echo $tp ?>" />
                    </div>
                    <span class="text-danger">
                      <?php echo $tpError; ?>
                    </span>
                  </div>
                  
                  <div class="form-group">
                    <hr />
                  </div>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="cus-reg">Register </button>
                  </div>
                  
                  <div class="form-group">
                    <hr />
                  </div>
              </form>
              </div>
            </div> 

</body>
</html>
<?php ob_end_flush(); ?>