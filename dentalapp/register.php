<!DOCTYPE html>
<html lang="en" >
<?php
require('config.php');
if (isset($_REQUEST['firstname'])){
  // removes backslashes
$firstname = stripslashes($_REQUEST['firstname']);
  //escapes special characters in a string
$firstname = mysqli_real_escape_string($conn,$firstname);

$surname = stripslashes($_REQUEST['surname']);
$surname = mysqli_real_escape_string($conn,$surname);

$email = stripslashes($_REQUEST['email']);
$email = mysqli_real_escape_string($conn,$email);

$dob = date($_REQUEST['dob']);

$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($conn,$password);

$confirmpassword = stripslashes($_REQUEST['confirmpassword']);
$confirmpassword = mysqli_real_escape_string($conn,$confirmpassword);

  $query = "INSERT into `patients` (First_Name, Surname, Email_Address, Password, DOB)
VALUES ('$firstname','$surname','$email','".md5($password)."','$dob')";
  $result = mysqli_query($conn,$query);
  if($result && ($password==$confirmpassword)){
      echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
  }else{
    echo"<h3>Registration Failed - Passwords do not match!</h3>";
  }
}else{
?>
<head>
  <meta charset="UTF-8">
  <title>Dental App-Register</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="register.php"><i class="fa fa-refresh"></i></a> 
</div>

    <div class="wrapper">
   <!-- <form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>-->
    <form class="form-signin" action="" method="POST" >       
      <center><h2 class="form-signin-heading">Logo</h2></center>
      <input type="text" class="form-control" name="firstname" placeholder="First Name" required=""/>
      <input type="text" class="form-control" name="surname" placeholder="Surname" required=""/>
      <input type="email"  class="form-control" name="email" placeholder="Email" required />
      <input type="date" class="form-control" name="dob" placeholder="Date of Birth" required=""/><br>

      <input type="password" class="form-control" name="password" placeholder="Password" required=""/> 
      <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required=""/>      
      <input type="submit" name="submit" value=" Sign Up"/><br>
      <a href="login.php">Already a Member? Login Here!</a>   
    </form>
  </div>
  ​<div class="footer">
  <a href="#">Dentist Login</a>
</div>
<?php
}
?>
</body>
</html>