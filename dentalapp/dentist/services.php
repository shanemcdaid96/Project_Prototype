<!DOCTYPE html>
<html lang="en" >
<?php
require('../config.php');
include("authDentist.php");
?>

<head>
  <meta charset="UTF-8">
  <title>DentalApp - Services(Dentist)</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <script src="https://d3js.org/d3.v4.min.js"></script>  
          <link rel="stylesheet" href="../css/style.css">
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="services.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
  <a href="#"><i class=""></i></a> 
  <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-wrench"></i></a> 
</div>
<div class="name-bar">
<h4>Logged In As: <?php echo $_SESSION['name'] ?></h4>
</div>
<div id="wrapper" class="toggled">

<!-- Sidebar -->
<?php include("sidebar.php"); ?>
<!-- /#sidebar-wrapper -->

    <div class="wrapper">
    <form class="form-signin">       
    <center><img src="../logo.png" width="300" height="200"><br>
    <h3 class="form-signin-heading">Services</h3></center>
        <div class="col-md-12">
            <div class="pull-right">
             
               <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add Service</button>
            </div>
        </div>
        <div class="service_content"></div>
    </tbody>
    </table>  
    </form>
 
  </div><br>
  <form class="form-signin">
  <center><h3 class="form-signin-heading">Current Prices Across Donegal</h3></center> 
    <div id="chart"></div>
    <form>
  	<center><label><input type="radio" name="treatment" value="denture"> Dentures</label>
  		<label><input type="radio" name="treatment" value="exam"> Examinations</label>
  		<label><input type="radio" name="treatment" value="crown"> Crowns</label>
  		<label><input type="radio" name="treatment" value="filling"> Fillings</label>
</center>
	</form>
</form>

  ​<div class="footer">
</div>
<!-- Modal -->
<div class="modal fade" id="addModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Service</h4>
      </div>
      <div class="modal-body">
        <label>Service</label>
        <input type="text" class="form-control" name="addservice" id="addservice" required><br>
        <label>Price</label>
        <input type="text" class="form-control" name="addprice" id="addprice" required><br>
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary"  onclick="addService()">Add Service</button>
      </div>
    </div>
    
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Service</h4>
      </div>
      <div class="modal-body">
        <label>Service</label>
        <input type="text" class="form-control" name="updateservice" id="updateservice" required><br>
        <label>Price</label>
        <input type="text" class="form-control" name="updateprice" id="updateprice" required><br>
        <input type="hidden" id="service_id" value="service_id">
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary"  onclick="UpdateService()">Update Service</button>
      </div>
    </div>
    
  </div>
</div>




<script type="text/javascript" src="../js/menutoggle.js"></script>
<script type="text/javascript" src="../js/services.js"></script>
<script type="text/javascript" src="../js/chart4.js"></script>

</body>
</html>

