<!DOCTYPE html>
<html lang="en" >
<?php
require('../config.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['email'])){
  // removes backslashes
$email = stripslashes($_REQUEST['email']);
  //escapes special characters in a string
$email = mysqli_real_escape_string($conn,$email);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($conn,$password);
//Checking is user existing in the database or not
  $query = "SELECT * FROM `dentists` WHERE Email_Address='$email'
and Password='".md5($password)."'";
$result = mysqli_query($conn,$query) or die(mysqli_error());
$rows = mysqli_num_rows($result);
  if($rows==1){
$_SESSION['emailDentist'] = $email;

      // Redirect user to index.php
header("Location: home.php");
   }else{
     ?>
<script>
alert("Username/password is incorrect");
window.location.href = "login.php";
</script>
<?php
}
}else{
?>

<head>
  <meta charset="UTF-8">
  <title>DentalApp- Dentist Login</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="../css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="index.php"><i class="fa fa-refresh"></i></a> 
</div>

    <div class="wrapper">
    <form class="form-signin" action="" method="post">       
      <center><h2 class="form-signin-heading"><img src="../logo.png" width="150" height="150"></h2></center>
      <input type="email" class="form-control" name="email" placeholder="Email Address" required="" autofocus=""  />
      <input type="password" class="form-control" name="password" placeholder="Password" required="" />      
      <input type="submit" class="btn btn-info btn-block" value="Login">
      <a href="../index.php"> Patient Login!</a>   
    </form>
  </div>
  ​<div class="footer">
</div>
<?php } ?>
</body>
</html>
