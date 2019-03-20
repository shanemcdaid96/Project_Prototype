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

$sql="Select * From patients WHERE Email_Address='$_REQUEST[email]'";

$result2 = $conn->query($sql);
     
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo '<script> alert("Email address already taken!!");';
        echo 'window.location.href = "register.php";';
        echo '</script>';
    }
} else {
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn,$email);
  $dob = date($_REQUEST['dob']);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn,$password);
  $phone = stripslashes($_REQUEST['phone']);
  $phone = mysqli_real_escape_string($conn,$phone);
  $sex = stripslashes($_REQUEST['sex']);
  $sex = mysqli_real_escape_string($conn,$sex);
  $pps = stripslashes($_REQUEST['pps']);
  $pps = mysqli_real_escape_string($conn,$pps);
  $confirmpassword = stripslashes($_REQUEST['confirmpassword']);
  $confirmpassword = mysqli_real_escape_string($conn,$confirmpassword);


   if($password!=$confirmpassword){
    echo '<script> alert("Registration Failed - Passwords do not match!!");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
   }else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0){
    echo '<script> alert("Registration Failed - Passwords do not meet password requirements!!");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
   }
   else{

  $query = "INSERT into `patients` (First_Name, Surname, Email_Address, Password, DOB, Sex, Phone_Number, PPS_Number)
VALUES ('$firstname','$surname','$email','".md5($password)."','$dob','$sex','$phone','$pps')";
  $result = mysqli_query($conn,$query);
  if($result){
    echo '<script> alert("Registration Successful");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
   }
 }
}
}else{
?>
<head>
  <meta charset="UTF-8">
  <title>Dental App-Register</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="register.php"><i class="fa fa-refresh"></i></a> 
</div>

    <div class="wrapper">
    <form class="form-signin" action="" method="POST" >       
    <center><h2 class="form-signin-heading"><img src="logo.png" width="150" height="150"></h2></center> 
      <label >First Name:</label>
      <input type="text" class="form-control" name="firstname" placeholder="First Name" required=""/><br>

      <label >Surname:</label>
      <input type="text" class="form-control" name="surname" placeholder="Surname" required=""/><br>

      <label >Email Address:</label>
      <input type="email"  class="form-control" name="email" placeholder="Email" required /><br>

      <label >Phone/Mobile Number:</label>
      <input type="phone"  class="form-control" name="phone" placeholder="Number" required /><br>

      <label >Sex:</label>
      <select class="form-control" id="sex" name="sex" requiired>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
      </select><br>

      <label >Date of Birth:</label>
      <input type="date" class="form-control" name="dob" placeholder="Date of Birth" required=""/><br>

      <label >PPS Number (Optional):</label>
      <input type="text"  class="form-control" name="pps" placeholder="PPS Number" /><br>

      <label >Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/><br> 

      <label >Confirm Password:</label>
      <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required=""/><br>      
      <input type="submit" class="btn btn-info btn-block" value="Sign Up"><br>
      <a href="index.php">Already a Member? Login Here!</a>   
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