<!DOCTYPE html>
<html lang="en" >
<?php
require('config.php');
include("auth.php");
include("timepicker.php");
?>

<head>
  <meta charset="UTF-8">
  <title>DentalApp - Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
 <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="viewbookings.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
</div>

    <div class="wrapper">
    <form class="form-signin" method="POST" action="">       
      <center><h2 class="form-signin-heading">Logo</h2></center> 
      <table class="table">
    <thead>
      <tr>
        <th>Time</th>
        <th>Date</th>
        <th>Type</th>
        <th>With</th>
        <th></th>
        <th></th>

      </tr>
    </thead>
    <tbody>
     <?php
     //Get All Appointments based on User's Session ID
     $sql = "SELECT * FROM appointment a, services s, dentists d WHERE a.userID='$_SESSION[id]' AND a.serviceID=s.service_id AND a.dentistID=d.Dentist_Id";
     $result = $conn->query($sql);
     
     if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
          $id=$row["app_ID"];

            echo "<tr id=".$row["app_ID"]."><td>". $row["appTime"]. "</td><td> " . $row["appDate"] . "</td><td>".$row["service_type"]."</td><td>".$row["Full_Title"]."</td>";
            echo "<td><button type='button' class='btn' data-toggle='modal' data-target='#edit-item' id='".$row["app_ID"]."'>Edit</td>";
            echo "<td><button class='btn btn-danger btn-sm remove'>Cancel</button></td><tr>";
      
         }
     } else {
         echo "0 results";
        }
   
     ?>   
    </tbody>
    </table>   
    </form> 
  ​<div class="footer">
</div>
	<!-- Edit Item Modal -->
  <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit Appointment</h4>
		      </div>

          <form class="form-signin" action="updatebooking.php" method="POST">
          <div class="form-group">
                               <label for="rollno">Appointment ID</label>
                               <input type="text" class="form-control" name="rollno" id="frm_rollno" readonly>
                           </div>       
     <?php
             //Name    
             echo "<label>Name:</label>"; 
             echo "<input type='text' class='form-control' name='name' value=' ". $_SESSION["firstname"]. " " . $_SESSION["surname"] . "' readonly><br>";
            
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
                <input type="text" class="form-control" name="datepicker" id="datepicker" required><br>
  <?php
             //Submit
             echo " <input type='submit' name='submit' class='btn btn-info btn-block' value='Update Appointment'> ";
     ?>
    </form>


		      </div>
		    </div>
		  </div>
		</div>

	</div>
</body>
</html>
