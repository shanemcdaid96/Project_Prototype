<?php
require('../config.php');
include("../timepicker.php");
include("authDentist.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="../css/style.css">
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <meta charset="UTF-8">
    <title>DentalApp - Appointments(Dentist)</title>

    <!-- Bootstrap CSS File  -->
   <!-- <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>-->
</head>
<body>
<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="appointments.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
  <a href="#"><i class=""></i></a> 
  <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-wrench"></i></a> 
</div>
<div class="name-bar">
<h4>Logged In As: <?php echo $_SESSION['name'] ?></h4>
</div>
<div id="wrapper" class="toggled">

<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
    <h4>Settings</h4>
         <li>
            <a href="#">Change Password</a>
        </li>
        <li>
            <a href="createDentist.php">Create Dentist Account</a>
        </li>
        <li>
            <a href="#">Create Patient Account</a>
        </li>
        <li>
            <a href="logoutDentist.php">Log Out</a>
        </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->

<!-- Content Section -->
<div class="wrapper"> 
<form class="form-signin">   
<center><h2 class="form-signin-heading"><img src="../logo.png" width="150" height="150"></h2></center>        
    <div class="row">
        <div class="col-md-12">
            <h1></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Appointment</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Appointments:</h3>

            <div class="records_content"></div>
        </div>
    </div>
    </div>
    
 ​<div class="footer">
</div>
<!-- /Content Section -->


<!-- Bootstrap Modals -->
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Appointment Details</h4>  
                </div>  
                <div class="modal-body" id="appointment_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="first_name">Name</label>
                    <?php
                          echo "<input type='text' id='name' class='form-control' name='name' value=' ". $_SESSION["name"]."' readonly><br>";
                          echo "<input type='hidden' id='user_ID' value='".$_SESSION["dID"]."'>" ?>
                </div>
                <?php
                             //Patient
                             echo "<label>Search Patient</label>";
                             echo "<input type='text' class='form-control' name='patient' id='patient' autocomplete='off' placeholder='Search by ID or Email Address' /><br>";
                             echo "<label>Patient</label>";
                             echo "<div id='patientResult' name='patientResult'></div><br>";
                       
                            //Appointment
                            echo "<label>Appointment Type</label>";
                            $sql3 = "SELECT * FROM services";
                            $result3 = $conn->query($sql3);
                            echo "<div class='select'>";

                            if ($result3->num_rows > 0) {
                            // output data of each row
                            echo "<select name='services' id='services' class='services'>";
                            while($row3 = $result3->fetch_assoc()) {
                            echo "<option  data-price='".$row3["price"]."'>". $row3["service_type"]. "</option>";

                            }
                            } else {
                            echo "0 results";
                            }
                            echo "</select>";
                            echo "</div><br>";
                                   //Price
              echo "<label>Price:</label>";
              echo "<span class='price'></span><br>";
              ?>
                    <script src="../js/services.js"> </script>
              <?php
             //Payment Method       
             echo "<label>Payment Method </label>";
             echo "<div class='select'>";
             echo "<select name='payment' id='payment'><option value='cash'>Cash</option>";
             echo "<option value='hse'>HSE Medical Card</option>";
             echo "<option value='card'>Credit/Debit Card</option></select></div><br>";
  
             //Time
             echo "<label>Time: </label>";
       
            echo "<select name='time' id='time' class='select'> " .get_times(). "</select><br>";
             //Date
             echo "<label>Date: </label><br>";?>

                <script src="../js/datepicker.js"> </script>
                <input type="text" class="form-control" name="datepicker" id="datepicker" required><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addDentistRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_first_name">Name</label>
                    <?php
                          echo "<input type='text' id='update_name' class='form-control' name='name' value=' ". $_SESSION["name"].  "' readonly><br>"; 
                          echo "<input type='hidden' id='update_user_ID' value='".$_SESSION["dID"]."'>" ?>
                </div>
                <?php
                             //Patient
                             echo "<label>Search Patient</label>";
                             echo "<input type='text' class='form-control' name='update_patient' id='update_patient' autocomplete='off' placeholder='Search by ID or Email Address' /><br>";
                             echo "<label>Patient</label>";
                             echo "<div id='update_patientResult' name='update_patientResult'></div><br>";
                          
                            //Appointment
                            echo "<label>Appointment Type</label>";
                            $sql3 = "SELECT * FROM services";
                            $result3 = $conn->query($sql3);
                            echo "<div class='select'>";

                            if ($result3->num_rows > 0) {
                            // output data of each row
                            echo "<select name='services' id='update_services' class='services'>";
                            while($row3 = $result3->fetch_assoc()) {
                            echo "<option  data-price='".$row3["price"]."'>". $row3["service_type"]. "</option>";

                            }
                            } else {
                            echo "0 results";
                            }
                            echo "</select>";
                            echo "</div><br>";
                                   //Price
              echo "<label>Price:</label>";
              echo "<span class='price'></span><br>";
              ?>
              <?php
             //Payment Method       
             echo "<label>Payment Method </label>";
             echo "<div class='select'>";
             echo "<select name='payment' id='update_payment'><option value='cash'>Cash</option>";
             echo "<option value='hse'>HSE Medical Card</option>";
             echo "<option value='card'>Credit/Debit Card</option></select></div><br>";
  
             //Time
             echo "<label>Time: </label>";
       
            echo "<select name='time' id='update_time' class='select'> " .get_times(). "</select><br>";
             //Date
             echo "<label>Date: </label><br>";?>
                 <script src="../js/updatedatepicker.js"> </script>
                <input type="text" class="form-control" name="updatedatepicker" id="updatedatepicker" required><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateDentistDetails()" >Save Changes</button>
                <input type="hidden" id="app_ID" value="app_ID">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
<!-- Custom JS file -->
<script type="text/javascript" src="../js/scriptDentist.js"></script>
<script type="text/javascript" src="../js/menutoggle.js"></script>
<script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-75591362-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
