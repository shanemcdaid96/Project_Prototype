<!DOCTYPE html>
<html lang="en" >
<?php
include("authDentist.php");
require("../config.php");
?>

<head>

  <meta charset="UTF-8">
  <title>DentalApp - Chart</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>

      <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.25.0/babel.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>  
</head>
<body>

	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="trendalerts.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
  <a href="#"><i class=""></i></a> 
  <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-wrench"></i></a> 

</div>  
<div class="name-bar">
<h4>Logged In As: <?php echo $_SESSION['name'] ?></h4>
</div>   
<div id="wrapper" class="toggled">

<!-- Sidebar -->
<?php include("sidebar.php"); ?>
  <div class="wrapper">
  <form class="form-signin">       
  <center><img src="../logo.png" width="300" height="200"><br>
    <h3 class="form-signin-heading">Trends</h3></center>
 <div id="chart"></div><br>
</form><br>
    <form class="form-signin" action="" method="POST"> 
    <label for="comment">Create New Trend Alert: </label>
      <textarea name="message" class="form-control" rows="5" id="comment" required></textarea><br>
 <div class="age-dropdown"> 
 <label for="comment">Age Group: </label>        
<select  name="sab"  class="req"  id="age-range" style="width:50px; height:30px;" autocomplete="off" required/> </select>
<i class="fa fa-arrows-h" style="font-size:24px"></i>
<select  name="eab"  class="req"  id="second" style="width:50px; height:30px;" autocomplete="off" required/> </select>
</div><br>
<?php
  echo "<label>Services</label>";
  $sql3 = "SELECT * FROM services";
  $result3 = $conn->query($sql3);
  echo "<div class='select'>";
 
  if ($result3->num_rows > 0) {
   // output data of each row
   echo "<select name='services' id='services' class='services'>";
   while($row3 = $result3->fetch_assoc()) {
       echo "<option  data-price='".$row3["price"]."'>". $row3["service_type"]. "</option>";
       
   }
} else {
   echo "0 results";
}
  echo "</select>";
   echo "</div><br>";

?>
<input type='button' name='submit' class='btn btn-info btn-block' value='Create Alert' onclick="addAlert()"><br>
</form><br>
<form class="form-signin"> 
<label>Current Trend Alerts</label>
<div class="alerts"></div>
</form>
</div>
<div id="chart2"></div><br>
  ​<div class="footer">
</div>
</body>
<script src="../js/chart.js"></script>
<script src="../js/chart2.js"></script>
<script src="../js/chart3.js"></script>
<script src="../js/agerange.js"></script>
<script type="text/javascript" src="../js/menutoggle.js"></script>
<script type="text/javascript" src="../js/services.js"></script>

</html>