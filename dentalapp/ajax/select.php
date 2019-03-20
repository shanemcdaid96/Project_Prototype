 <?php  
  require('config.php');
 if(isset($_POST["id"]))  
 {        
      $output = '';   
      $query = "SELECT * FROM appointment a, services s, dentists d WHERE a.serviceID=s.service_id AND a.dentistID=d.Dentist_Id AND a.app_ID = '".$_POST["id"]."'";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Time</label></td>  
                     <td width="70%">'.$row["appTime"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Date</label></td>  
                     <td width="70%">'.$row["appDate"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Service</label></td>  
                     <td width="70%">'.$row["service_type"].'</td>  
                </tr>  
                <tr>  
                <td width="30%"><label>Fee</label></td>  
                <td width="70%">€'.$row["price"].'</td>  
           </tr> 
                <tr>  
                     <td width="30%"><label>Dentist</label></td>  
                     <td width="70%">'.$row["Full_Title"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Payment</label></td>  
                     <td width="70%">'.$row["paymentMethod"].'</td>  
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