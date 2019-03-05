<?php  
require('config.php');
include("auth.php");
include("timepicker.php");
 if(!empty($_POST))  
 {  
   //Get Dentist ID
    $sql = "SELECT * FROM dentists WHERE Full_Title='$_POST[dentist]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $dentistID = $row['Dentist_Id'];
   //Get Selected Service ID
    $sql2 = "SELECT * FROM services WHERE service_type='$_POST[services]'";
      $result = mysqli_query($conn, $sql2);
      $row1 = mysqli_fetch_assoc($result);
      $serviceID = $row1['service_id'];

      $output = '';  
      $message = '';  
      $payment = mysqli_real_escape_string($conn, $_POST["payment"]);  
      $time = mysqli_real_escape_string($conn, $_POST["time"]);  
      $date = mysqli_real_escape_string($conn, $_POST["datepicker"]);
      $id =$_SESSION["id"]; 
      
         //Check for Double Booking
        $bookingcheck="SELECT * FROM appointment WHERE dentistID='$dentistID' AND appDate='$date' AND appTime='$time'";
         $resultCheck = $conn->query($bookingcheck);   

      if($_POST["app_ID"] != '')  
      { 
          if ($resultCheck->num_rows > 0) {
               // output data of each row
               while($rowCheck = $resultCheck->fetch_assoc()) {
                   echo '<script src="js/doublebooking.js"></script>';
               }
          }else{
           $query = "  
           UPDATE appointment   
           SET appDate='$date',   
           appTime='$time',   
           dentistID='$dentistID',   
           userID = '$id',   
           serviceID = '$serviceID',
           paymentMethod = '$payment'   
           WHERE app_ID='".$_POST["app_ID"]."'";  
           $message = 'Appointment Updated';
          }
     } 
     else{
      //If no records exist, book appointment
      if ($resultCheck->num_rows > 0) {
          // output data of each row
          while($rowCheck = $resultCheck->fetch_assoc()) {
              echo '<script src="js/doublebooking.js"></script>';
          }
     }else{
      $query = "  
      INSERT INTO appointment(appDate, appTime, dentistID, userID, serviceID, paymentMethod)  
      VALUES('$date', '$time', '$dentistID', '$id', '$serviceID','$payment');  
      ";  
      $message = 'Appointment Booked';
     }
    } 
         if(mysqli_query($conn, $query))  
         {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM appointment ORDER BY app_ID DESC";  
           $result = mysqli_query($conn, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="35%">Date</th>
                          <th width="35%">Time</th>  
                          <th width="10%">Edit</th>  
                          <th width="10%">View</th>
                          <th width="10%">Delete</th>

                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["appDate"] . '</td>  
                          <td>' . $row["appTime"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["app_ID"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="View" id="' . $row["app_ID"] . '" class="btn btn-info btn-xs view_data" /></td>
                          <td><input type="button" name="delete" value="Delete" id="' . $row["app_ID"] . '" class="btn btn-info btn-xs delete_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
           echo $output;
      }else{
        echo "Fail";
      } 
 } 
 ?>
 