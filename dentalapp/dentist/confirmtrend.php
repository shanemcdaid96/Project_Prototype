<?php
require('../config.php');
//include("auth.php");

if (isset($_POST['submit'])){
   //Get Selected Service ID
    $sql2 = "SELECT * FROM services WHERE service_type='$_POST[services]'";
      $result = mysqli_query($conn, $sql2);
      $row1 = mysqli_fetch_assoc($result);
      $serviceID = $row1['service_id'];
     
  
    
      $query = "INSERT into `trend_alerts` (message, min_age, max_age, treatment_id)
       VALUES ('$_POST[message]','$_POST[sab]','$_POST[eab]','$serviceID')";
         $result = mysqli_query($conn,$query);
         if($result){
           echo '<script>alert("Working");</script>';
             }
        
       }

?>