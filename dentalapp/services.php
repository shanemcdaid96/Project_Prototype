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
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="services.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
  <a href="#"><i class=""></i></a> 
  <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-wrench"></i></a> 
</div>
<div class="name-bar">
<h4>Logged In As: <?php echo $_SESSION['firstname'] ,' ',$_SESSION['surname']  ?></h4>
</div>
<div id="wrapper" class="toggled">

<?php include("patient-sidebar.php"); ?>

    <div class="wrapper">
    <form class="form-signin">       
    <center><img src="logo.png" width="300" height="200"><br>
    <h3 class="form-signin-heading">Services</h3></center>
      <table class="table">
    <thead>
      <tr>
        <th>Service</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
     <?php
     //Get service details
     $stmt = $conn->prepare("SELECT * FROM services");
     $stmt->execute();
     $result = $stmt->get_result();
     if($result->num_rows === 0) exit('No rows');
     while($row = $result->fetch_assoc()) {
      echo "<tr><td>". $row["service_type"]. "</td><td> €" . $row["price"] . "</td></tr>";
     }
  $stmt->close();
     ?>
    </tbody>
    </table>    

    </form>
  </div>
  ​<div class="footer">
</div>
  
  

</body>
<script type="text/javascript" src="js/menutoggle.js"></script>
</html>
