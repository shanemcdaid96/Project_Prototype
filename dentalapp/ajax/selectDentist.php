<?php  
  require('config.php');
 if(isset($_POST["id"]))  
 {        
      $output = '';   
   //Get details of selected appointment
    $stmt= $conn->prepare($query = "SELECT appTime,appDate,service_type,price,First_Name,Surname,paymentMethod FROM appointment a, services s, patients p WHERE a.serviceID=s.service_id AND a.userID=p.Id AND a.app_ID=?");
    $stmt->bind_param("i", $id);
    $id = $_POST["id"];
    $stmt->execute();
    $stmt->bind_result($appTime,$appDate,$service_type,$price,$First_Name,$Surname,$paymentMethod);
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
  
       while($stmt->fetch())  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Time</label></td>  
                     <td width="70%">'.$appTime.'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Date</label></td>  
                     <td width="70%">'.$appDate.'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Service</label></td>  
                     <td width="70%">'.$service_type.'</td>  
                </tr>  
                <tr>  
                <td width="30%"><label>Fee</label></td>  
                <td width="70%">€'.$price.'</td>  
           </tr> 
                <tr>  
                     <td width="30%"><label>Patient</label></td>  
                     <td width="70%">'.$First_Name.' '.$Surname. '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Payment</label></td>  
                     <td width="70%">'.$paymentMethod.'</td>  
                </tr>  
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>