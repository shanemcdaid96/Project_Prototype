<!DOCTYPE html>
<html lang="en" >
<?php
require('config.php');
include("auth.php");
include("timepicker.php");

$query = "SELECT * FROM appointment ORDER BY app_ID DESC";  
$result = mysqli_query($conn, $query);  
?>
<head>
        <meta charset="UTF-8">
        <title>DentalApp - Book Appointment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  
         <link rel="stylesheet" href="css/style.css">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="bookappointments.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
  <a href="#"><i class=""></i></a> 
  <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-wrench"></i></a> 
</div>
<div class="name-bar">
<h4>Logged In As: <?php echo $_SESSION['firstname'] ,' ',$_SESSION['surname']  ?></h4>
</div>
<div id="wrapper" class="toggled">

<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
    <h4>Settings</h4>
        <li>
            <a href="#">Change User Password</a>
        </li>
        <li>
            <a href="logout.php">Log Out</a>
        </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
    <div class="wrapper">
    <form class="form-signin" action="confirmbooking.php" method="POST">       
      <center><h2 class="form-signin-heading">Logo</h2></center> 
      <div class="table-responsive">  
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success">Add Appointment</button>  
                     </div>  
                     <br />  
                     <div id="employee_table">  
                          <table class="table table-bordered">  
                               <tr>  
                                    <th width="35%">Date</th>  
                                    <th width="35%">Time</th>  
                                    <th width="10%">Edit</th>  
                                    <th width="10%">View</th>  
                                    <th width="10%">Delete</th>
                               </tr>  
                               <?php  
                               while($row = mysqli_fetch_array($result))  
                               {  
                               ?>  
                               <tr>  
                                    <td><?php echo $row["appDate"]; ?></td>  
                                    <td><?php echo $row["appTime"]; ?></td> 
                                    <td><input type="button" name="edit" value="Edit" id="<?php echo $row["app_ID"]; ?>" class="btn btn-secondary btn-xs edit_data" /></td>  
                                    <td><input type="button" name="view" value="View" id="<?php echo $row["app_ID"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                                    <td><input type="button" name="delete" value="Delete" id="<?php echo $row["app_ID"]; ?>" class="btn btn-danger btn-xs delete_data" /></td>   
                               </tr>  
                               <?php  
                               }  
                               ?>  
                          </table>  
                     </div>  
                </div>  
    </form>
  </div>
  ​<div class="footer">
</div>
</body>
</html>
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Appointment Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Insert Appointment Information</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Name:</label>  
                          <?php
                          echo "<input type='text' class='form-control' name='name' value=' ". $_SESSION["firstname"]. " " . $_SESSION["surname"] . "' readonly><br>"; ?>
                          <br />  
                          <?php
                                       //Dentist
                            $sql2 = "SELECT * FROM dentists";
                            $result2 = $conn->query($sql2);
                            echo "<label>Dentist:</label>"; 
                            echo "<div class='select'>";
                            echo "<select name='dentist' id='dentist'>";
                            if ($result2->num_rows > 0) {
                            // output data of each row
                            while($row2 = $result2->fetch_assoc()) {
                            echo "<option> ". $row2["Full_Title"] . "</option>";
                            }
                            } else {
                            echo "0 results";
                            }
                            echo "</select>";
                            echo "</div><br>";
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
                <script src="js/services.js"> </script>
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

          <script src="js/datepicker.js"></script>
                <input type="text" class="form-control" name="datepicker" id="datepicker" required readonly><br>
             <input type="hidden" name="app_ID" id="app_ID" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success btn-block"  />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <script src="js/crudAppointments.js"> </script>
 <script type="text/javascript" src="js/menutoggle.js"></script>
 