<?php
require('config.php');
include("auth.php");

if (isset($_POST['submit'])){
    //Get Selected Dentist ID
    $sql = "SELECT * FROM dentists WHERE Full_Title='$_POST[dentist]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $dentistID = $row['Dentist_Id'];
   //Get Selected Service ID
    $sql2 = "SELECT * FROM services WHERE service_type='$_POST[services]'";
      $result = mysqli_query($conn, $sql2);
      $row1 = mysqli_fetch_assoc($result);
      $serviceID = $row1['service_id'];

      //Check for Double Booking
      $bookingcheck="SELECT * FROM appointment WHERE dentistID='$dentistID' AND appDate='$_POST[datepicker]' AND appTime='$_POST[time]'";
      $resultCheck = $conn->query($bookingcheck);    
      if ($resultCheck->num_rows > 0) {
          // output data of each row
          while($rowCheck = $resultCheck->fetch_assoc()) {
              echo '<script src="js/doublebooking.js"></script>';
          }
      } else {
      //If no records exist, book appointment
      $query = "INSERT into `appointment` (appDate, appTime, dentistID, userID,serviceID, paymentMethod)
       VALUES ('$_POST[datepicker]','$_POST[time]', '$dentistID','$_SESSION[id]','$serviceID','$_POST[payment]')";
         $result = mysqli_query($conn,$query);
         if($result){
           echo '<script src="js/bookingsuccess.js"></script>';
             }
          }
       }

?>