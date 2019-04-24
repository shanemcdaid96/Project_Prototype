<!DOCTYPE html>
<html lang="en" >
<?php
include("authDentist.php");
?>

<head>
  <meta charset="UTF-8">
  <title>DentalApp - Dentist Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/style.css">


  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="home.php"><i class="fa fa-refresh"></i></a> 
  <a href="#"><i class=""></i></a> 
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
    <h3 class="form-signin-heading">Dentist Menu</h3></center>    
      <a href="appointments.php"><button class="btn btn-lg btn-primary btn-block" type="button">Appointments</button></a><br> 
     <a href="services.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Services</button></a><br> 
     <a href="trendalerts.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Trends</button></a><br>
      <a href="logoutDentist.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Log Out</button></a><br> 
    </form>
  ​<div class="footer">
</div>
</div>
  

</body>
<script type="text/javascript" src="../js/menutoggle.js"></script>
</html>
