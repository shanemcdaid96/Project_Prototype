<?php
require('../config.php');
//include("auth.php");

if (isset($_POST['submit'])){
   //Get Selected Service ID
   $sql2= $conn->prepare("SELECT service_id FROM services WHERE service_type=?");
   $sql2->bind_param("s", $_POST["services"]);
   $sql2->execute();
   $sql2->store_result();
   $sql2->bind_result($service_id);
   $sql2->fetch();
   $serviceID=$service_id;
     
  
    
   /*   $query = "INSERT into `trend_alerts` (message, min_age, max_age, treatment_id)
       VALUES ('$_POST[message]','$_POST[sab]','$_POST[eab]','$serviceID')";
         $result = mysqli_query($conn,$query);*/
         $stmt = $conn->prepare("INSERT INTO trend_alerts(message, min_age, max_age, treatment_id) 
         VALUES(?,?,?,?)");
         $stmt->bind_param("siii",$_POST["message"],$_POST["sab"],$_POST["eab"],$serviceID);
         $result=$stmt->execute();	 
         if($result){
           echo '<script>alert("Working");</script>';
             }
        
       }

?>