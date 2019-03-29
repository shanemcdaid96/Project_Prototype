<!DOCTYPE html>
<html lang="en" >
<?php
require('../config.php');
include("authDentist.php");
error_reporting(0);
ini_set('display_errors', 0);
if (isset($_REQUEST['newpassword'])){
  // removes backslashes
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn,$password);
  $confirmpassword = stripslashes($_REQUEST['confirmpassword']);
  $confirmpassword = mysqli_real_escape_string($conn,$confirmpassword);

  $newpassword = stripslashes($_REQUEST['newpassword']);
  $newpassword = mysqli_real_escape_string($conn,$newpassword);
  $confirmnewpassword = stripslashes($_REQUEST['confirmnewpassword']);
  $confirmnewpassword = mysqli_real_escape_string($conn,$confirmnewpassword);

   if($password !=$confirmpassword || $newpassword != $confirmnewpassword ){
    echo '<script> alert("Change Failed - Passwords do not match!!");';
    echo '</script>';
   }else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $newpassword) === 0){
    echo '<script> alert("Change Failed - Passwords do not meet password requirements!!");';
    echo '</script>';
   }
   else{
    
      //  $checkpassword = "SELECT * FROM dentists WHERE Password ='".md5($password)."' AND Dentist_Id='".$_SESSION[dID]."'";
        //$result = mysqli_query($conn,$checkpassword) or die(mysqli_error());
        //$rows = mysqli_num_rows($result);
       // if($rows == 1){  
        $checkpassword =$conn->prepare("SELECT Dentist_Id FROM dentists WHERE Password =? AND Dentist_Id=?");
        $checkpassword ->bind_param("si", md5($password),$_SESSION["dID"]);
        $checkpassword ->execute();
        $checkpassword ->store_result();
        if ($checkpassword ->num_rows == 1) {
        //$query ="UPDATE dentists SET Password ='".md5($newpassword)."' WHERE Dentist_Id='".$_SESSION[dID]."' ";
        //$result = mysqli_query($conn,$query);
        $stmt = $conn->prepare("UPDATE dentists SET Password =? WHERE Dentist_Id=?");
        $stmt->bind_param("si", md5($newpassword),$Dentist_Id);
        $result=$stmt->execute();
           if($result){
            echo '<script> alert("Password Change Successful");';
            echo 'window.location.href = "home.php";';
            echo '</script>';
            }
    }else{
        echo '<script> alert("Change Failed - Current Password does not match User Account Password!");';
        echo '</script>';
    }

    } 
}  
?>
<head>
  <meta charset="UTF-8">
  <title>Dental Password Change (Dentist)</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="../css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="changepassword.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
</div>

    <div class="wrapper">
    <form class="form-signin" action="" method="POST" >       
    <center><h2 class="form-signin-heading"><img src="../logo.png" width="150" height="150"></h2></center> 
      <label >Current Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Current Password" required=""/><br> 

      <label >Confirm Current Password:</label>
      <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required=""/><br>     
      
      <label >New Password:</label>
      <input type="password" class="form-control" name="newpassword" placeholder="New Password" required=""/><br> 

      <label >Confirm New Password:</label>
      <input type="password" class="form-control" name="confirmnewpassword" placeholder="Confirm New Password" required=""/><br>    
      <input type="submit" class="btn btn-info btn-block" value="Submit"><br>  
    </form>
  </div>
  ​<div class="footer">
  <a href="#">Dentist Login</a>+
</div>
</body>
</html>