<!DOCTYPE html>
<html lang="en" >
<?php
//include("auth.php");
?>

<head>
  <meta charset="UTF-8">
  <title>DentalApp - Dentist Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
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
<h4>Logged In As: <?php ?></h4>
</div>

<div id="wrapper" class="toggled">

<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
    <h4>Settings</h4>
        <li>
            <a href="#">Change User Password</a>
        </li>
        <li>
            <a href="createDentist.php">Create Dentist Account</a>
        </li>
        <li>
            <a href="#">Create Patient Account</a>
        </li>
        <li>
            <a href="#">Log Out</a>
        </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
 <div class="wrapper">
    <form class="form-signin">       
      <center><h2 class="form-signin-heading"><img src="../logo.png" width="150" height="150"></h2></center>     
      <a href="#"><button class="btn btn-lg btn-primary btn-block" type="button">Appointments</button></a><br> 
     <a href="services.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Services</button></a><br> 
     <a href="trendalerts.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Trends</button></a><br>
      <a href="#"> <button class="btn btn-lg btn-primary btn-block" type="button">Log Out</button></a><br> 
    </form>
  ​<div class="footer">
</div>
</div>
  

</body>
<script type="text/javascript" src="../js/menutoggle.js"></script>
</html>
