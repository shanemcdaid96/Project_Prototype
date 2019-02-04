<!DOCTYPE html>
<html lang="en" >
<?php
require('config.php');
include("auth.php");
?>

<head>
  <meta charset="UTF-8">
  <title>DentalApp - Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="services.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
</div>

    <div class="wrapper">
    <form class="form-signin">       
      <center><h2 class="form-signin-heading">Logo</h2></center> 
      <table class="table">
    <thead>
      <tr>
        <th>Service</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
     <?php
     $sql = "SELECT * FROM services";
     $result = $conn->query($sql);
     
     if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
             echo "<tr><td>". $row["service_type"]. "</td><td> €" . $row["price"] . "</td></tr>";
         }
     } else {
         echo "0 results";
     }

     ?>
    </tbody>
    </table>    

    </form>
  </div>
  ​<div class="footer">
  <a href="#">Dentist Login</a>
</div>
  
  

</body>

</html>
