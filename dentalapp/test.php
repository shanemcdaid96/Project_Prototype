
<?php
//include("auth.php");
$host = 'dentalapp-server.mysql.database.azure.com';
$username = 'shane@dentalapp-server';
$password = 'Gonero.32';
$db_name = 'trends';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

      $query = "SELECT * FROM dataset WHERE statistic='Denture Repairs (Number)'";
      $result = mysqli_query($conn, $query);
      $rows = mysqli_num_rows($result);
      
      mysqli_close($conn);
      
      if($rows > 0){
          $data = array();
          while (($r=mysqli_fetch_assoc($result))!=null){
              $data[] = $r;
          }
      
          header("Content-Type: application/json");
          echo json_encode($data);
          }
      
      ?>