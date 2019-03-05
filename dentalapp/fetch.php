 
  <?php  
 //fetch.php  
 require('config.php');
 if(isset($_POST["app_ID"]))  
 {  
     $query = "SELECT * FROM appointment a, services s, dentists d WHERE a.serviceID=s.service_id AND a.dentistID=d.Dentist_Id AND a.app_ID = '".$_POST["app_ID"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>