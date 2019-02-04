<!DOCTYPE html>
<html lang="en" >
<?php
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
  <a href="home.php"><i class="fa fa-refresh"></i></a> 
  <p><?php  echo $_SESSION["firstname"]; ?></p>

</div>

    <div class="wrapper">
    <form class="form-signin">       
      <center><h2 class="form-signin-heading">Logo</h2></center>     
      <a href="bookappointments.php"><button class="btn btn-lg btn-primary btn-block" type="button">Book an Appointment</button></a><br> 
      <button class="btn btn-lg btn-primary btn-block" type="button">View Bookings</button><br> 
     <a href="services.php"> <button class="btn btn-lg btn-primary btn-block" type="button">View Services</button></a><br> 
      <a href="logout.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Log Out</button></a><br> 
    </form>
  </div>
  ​<div class="footer">
  <a href="#">Dentist Login</a>
</div>
  
  

</body>

</html>
