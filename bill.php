<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page

if (!isset($_SESSION['user'])) {
	header("Location: default.php");
	exit;
}
date_default_timezone_set("Sri_Lanka/Colombo");
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
         
      </style>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <script type="text/javascript">
         var ppp= calculate() ;
         function calculate(){
            
           var a = document.getElementById("m0");
           var b = document.getElementById("m1");
           var c = document.getElementById("m2");
           var d = document.getElementById("m3");
           var e = document.getElementById("m4");
           var f = document.getElementById("m5");
           //var g = document.getElementById("m6");
           //ar h = document.getElementById("m7");
           var i = document.getElementById("m8");
           var r1=document.getElementById('result2');
           var r2=document.getElementById('result3');
           var r3=document.getElementById('result4');
           //var r4=document.getElementById('result5');
           var r5 = document.getElementById('result6');
           var r6 = document.getElementById('result7');
           
           if(a.value =="" || b.value ==""){
             r1.value ="0";
           }
           
           if(c.value =="" || d.value ==""){
             r2.value ="0";
           }
           if(e.value =="" || f.value ==""){
             r3.value ="0";
           }
           /*if(g.value =="" || h.value ==""){
             r5.value ="0";
           }*/
           if(i.value ==""){
             r6.value ="0";
           }
           
           r1.value = a.value * b.value;
           r2.value = c.value * d.value;
           r3.value = e.value * f.value;
           //r4.value = g.value * h.value;
           r6.value = i.value * -1;
           
           r5.value = Number(r1.value) + Number(r2.value) + Number(r3.value)  + Number(r6.value);
           window.r5.value;
         }
         function printDiv(printableArea) {
           $("#myModal").modal("hide");
           $('.modal-backdrop').remove();
           var printContents = document.getElementById(printableArea).innerHTML;
           var originalContents = document.body.innerHTML;
           document.body.innerHTML = printContents;
           window.print();
           document.body.innerHTML = originalContents;
           $("#myModal").modal("show");
         }
         function reload(){
           location.reload();
         }
      </script>
      <?php
      //calculation part
         $query = mysql_query("SELECT hired.vehicleId , markers.vehicleNumber,hired.vehicle , markers.kms , customer.cusId , customer.dateTime , customer.name , customer.address , customer.tp FROM hired INNER JOIN  markers ON hired.vehicleId = markers.vehicleId INNER JOIN customer ON customer.vehicleId  = markers.vehicleId WHERE hired.vehicleId = '" . $_GET['id'] . "'") or die(mysql_error());
         
         while ($row = mysql_fetch_array($query)) {
         	$vehicleId = $row[vehicleNumber];
         	$vehicle = $row[vehicle];
         	$kms = $row[kms];
         	$cusId = $row[cusId];
         	$dateTime = date("Y/n/j", strtotime($row["dateTime"]));
         	$name = $row[name];
         	$address = $row[address];
         	$tp = $row[tp];
         }
         
         $currentDate = date("Y/n/j");
         $startDate = strtotime($currentDate);
         $endDate = strtotime($dateTime);
         $daysDiff = ($startDate - $endDate) / 3600 / 24;
         $freeKms = $daysDiff * 100;
         
         if ($freeKms <= $kms) {
         	$diffkms = $kms - $freeKms;
         }
         elseif ($freeKms >= $kms) {
         	$diffkms = 0;
         }
         
         ?>
   </head>
   <body onbeforeprint="calculate()" onload="calculate()" >
      <?php include_once "nav.php"; ?>
      <div id="wrapper">
         <div class="container-fluid">
            <div class="page-header">
               <h3>Cab Service Management
               </h3>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">The Invoice
                     </div>
                     <div class="panel-body">
                        <div class="container outer-section">
                           <div id="printableArea" >
                              <div class="row pad-top font-big">
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <img style="max-width:500px; margin-top: -10px; "src="images/taxi.png">
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                     <br />
                                     <br />
                                    <strong>Smart Cab Services pvt.LTD</strong>
                                    <br />
                                    Address : Uva Wellassa University
                                    <br />
                                    Passara Road
                                    <br />
                                    Badulla.
                                    <br />
                                    E-mail: taxi@gmai.com
                                    <br />
                                    Call: 0712345678
                                 </div>
                              </div>
                              <br />
                              <hr />
                              <div class="row text-center">
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                    This is an electronic generated receipt , for any issues please contact the &nbsp;
                                    <strong> Management
                                    </strong>
                                 </div>
                              </div>
                              <hr />
                              <div class="row ">
                                 <div class="col-sm-4">
                                    <h3>Client Details :
                                    </h3>
                                    <strong>Name: </strong>
                                    <?php echo $name ; ?>
                                    <br>
                                    <strong>Address: </strong>
                                    <br> 
                                    <?php echo $address ; ?>
                                    <br>
                                    <strong>Telephone: </strong>
                                    
                                    <?php echo $tp ; ?>
                                    <br>
                                 </div>
                                 <div class="col-sm-4">
                                    <h3>Vehicle Details :
                                    </h3>
                                    <strong>Vehicle ID: </strong>
                                    <?php echo $vehicleId ; ?>
                                    <br>
                                    <strong>Vehicle: </strong>
                                    <?php echo $vehicle ; ?>
                                    <br>
                                    <strong>Covered Kilometers: </strong>
                                    <?php echo $kms ; ?> km
                                    <br>
                                    <strong>Free Kilometers per day: </strong>
                                    100 km
                                 </div>
                                 <div class="col-sm-4">
                                    <h3>Payment Details :
                                    </h3>
                                    <h4><strong>Invoice No: <?php echo $cusId ; ?> </strong></h4>
                                    <strong>Invoice Date: </strong>
                                    <?php echo date("Y/m/d") ; ?> 
                                    <br>
                                    <strong>Invoice Time: </strong>
                                    <?php echo date("h:i:sa") ; ?> 
                                    <br>
                                    <strong>Borrowed On: </strong>
                                    <?php echo $dateTime ; ?>  
                                    <br>
                                 </div>
                              </div>
                              <hr />
                              <br />
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                       <table class="table table-striped table-bordered table-hover">
                                          <thead>
                                             <tr>
                                                <th>S. No.
                                                </th>
                                                <th>Description
                                                </th>
                                                <th>Quantity.
                                                </th>
                                                <th>Unit Price(Rs.)
                                                </th>
                                                <th>Sub Total(Rs.)
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>1
                                                </td>
                                                <td>Day payement
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="m0" maxlength="5" size="5" value="<?php echo $daysDiff ; ?>"  onkeyup="calculate()">Days
                                                </td>
                                                <td>
                                                   <input type="text" class="form-control" id="m1" maxlength="5" size="5"value="1000"  onkeyup="calculate()">Per day
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="result2" maxlength="5" size="3" value="0"  onkeyup="calculate()"readonly >
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>2
                                                </td>
                                                <td>Cost For Kilometers
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="m2" maxlength="5" size="5" value="<?php echo $diffkms ; ?>" onkeyup="calculate()">Kilometers
                                                </td>
                                                <td>
                                                   <input type="text" class="form-control" id="m3" maxlength="5" size="5"value="100" onkeyup="calculate()">Per kilometer
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="result3" maxlength="5" size="3" value="0" onkeyup="calculate()" readonly>
                                                </td>
                                             </tr>
                                             <tr>
                                            <tr>
                                                <td>3
                                                </td>
                                                <td>Discounts
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="m8" maxlength="5" size="5" onkeyup="calculate()">
                                                </td>
                                                <td>
                                                   
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="result7" maxlength="5" size="3" value="0" onkeyup="calculate()" readonly>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>4
                                                </td>
                                                <td>
                                                   <input type="text" class="form-control" size="10" value="Other Charges">
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="m4" maxlength="5" size="5" onkeyup="calculate()">
                                                </td>
                                                <td>
                                                   <input type="text" class="form-control" id="m5" maxlength="5" size="5" onkeyup="calculate()">
                                                </td>
                                                <td> 
                                                   <input type="text" class="form-control" id="result4" maxlength="5" size="3" value="0" onkeyup="calculate()" readonly>
                                                </td>
                                             </tr>
                                             
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <hr />
                              <div class="row">
                                 <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 1px;">
                                    <strong>Total Amount in rupees:
                                    </strong>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3" style="text-align: left;">
                                    <strong>
                                    <input type="text" class="form-control" id="result6" maxlength="" size="0" value="0" onkeyup="calculate()" readonly>
                                    </strong>
                                 </div>
                                 <hr />
                              </div>
                              <hr />
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h6># If you have any issue, please contact us immediately.
                                    </h6>
                                    <h6># You can contact us between 10:am to 6:00 pm on all working days. 
                                       <?php echo "<script>document.writeln(r5).value;</script>"; ?>
                                    </h6>
                                 </div>
                              </div>
                           </div>
                           <hr />
                           <div class="row pad-bottom" >
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                 <h5>First print  invoice and then click on PAY button. 
                                 </h5>
                              </div>
                              <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#myModal">PRINT BILL
                              </button>
                              </br>
                              <!-- Modal -->
                              <div class="modal fade" id="myModal" role="dialog" data-dismiss="modal">
                                 <div class="modal-dialog" >
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;
                                          </button>
                                          <h4 class="modal-title">INVOICE PRINTING 
                                          </h4>
                                       </div>
                                       <div class="modal-body">
                                          <p>Confirm printing &nbsp;&nbsp;&nbsp; 
                                             <button type="button" class="btn btn-success"  onclick="printDiv('printableArea')" >Yes
                                             </button>
                                          </p>
                                          <br>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="close" onclick="reload()" data-dismiss="modal" >Close
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!------------------Model 2----------------------------------------------------------------------------------------------->
                              <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#myModal2">PAY</button>
                              <!-- Modal -->
                              <div class="modal fade" id="myModal2" role="dialog" data-dismiss="modal">
                                 <div class="modal-dialog" >
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;
                                          </button>
                                          <h4 class="modal-title">INVOICE CLOSING 
                                          </h4>
                                       </div>
                                       <div class="modal-body">
                                          <p>Confirm closing &nbsp;&nbsp;&nbsp;  
                                             <?php echo '<a href="invoiceclose.php?id='.$vehicleId.'" class="btn btn-success" role="button" > Yes</a>'; ?>
                                          </p>
                                          <br>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="close" onclick="reload()" data-dismiss="modal" >Close
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
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