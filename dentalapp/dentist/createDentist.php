<!DOCTYPE html>
<html lang="en" >
<?php

require('../config.php');
if (isset($_REQUEST['name'])){
  // removes backslashes

$name = "Dr. ".stripslashes($_REQUEST['name']);
  //escapes special characters in a string
$firstname = mysqli_real_escape_string($conn,$name);


$sql="Select * From dentists WHERE Email_Address='$_REQUEST[email]'";

$result2 = $conn->query($sql);
     
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo '<script> alert("Email address already taken!!");';
        echo '</script>';
    }
} else {
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn,$email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn,$password);
  $confirmpassword = stripslashes($_REQUEST['confirmpassword']);
  $confirmpassword = mysqli_real_escape_string($conn,$confirmpassword);


   if($password!=$confirmpassword){
    echo '<script> alert("Registration Failed - Passwords do not match!!");';
    echo 'window.location.href = "createDentist.php";';
    echo '</script>';
    
    //function checks if the entered password meets the following requirments
   }else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0){
    echo '<script> alert("Registration Failed - Passwords do not meet password requirements!!");';
    echo 'window.location.href = "createDentist.php";';
    echo '</script>';
   }
   else{

  $query = "INSERT into `dentists` (Full_Title,Email_Address, Password)
VALUES ('$name','$email','".md5($password)."')";
  $result = mysqli_query($conn,$query);
  if($result){
    echo '<script> alert("Dentist Succefully Added");';
    echo 'window.location.href = "createDentist.php";';
    echo '</script>';
   }
 }
}
}else{
?>
<head>
  <meta charset="UTF-8">
  <title>Dental App- Create Dentist Account</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="../css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="createDentist.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
</div>

    <div class="wrapper">
    <form class="form-signin" action="" method="POST" >       
    <center><img src="../logo.png" width="300" height="200"><br>
    <h3 class="form-signin-heading">Register Dentist</h3></center>
      <label >Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Full Name" required=""/><br>

      <label >Email Address:</label>
      <input type="email"  class="form-control" name="email" placeholder="Email" required /><br>

      <label >Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/><br> 

      <label >Confirm Password:</label>
      <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required=""/><br>      
      <input type="submit" class="btn btn-info btn-block" value="Create Dentist Account"><br>  
    </form>
  </div>
  ​<div class="footer">
</div>
<?php
}
?>
</body>
</html>