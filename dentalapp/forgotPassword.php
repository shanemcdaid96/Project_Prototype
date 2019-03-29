<!DOCTYPE html>
<html lang="en" >
<?php
require('config.php');
if (isset($_POST['email']) && ($_POST['email']!="")) {

  $email=$_POST['email'];
  $sql="SELECT * FROM `patients` WHERE Email_Address='$email'";
  $query = mysqli_query($conn,$sql);
  
  if(!$query) 
    {
    die(mysqli_error($conn));
    }
  
  if(mysqli_affected_rows($conn) != 0)
    {
  $row=mysqli_fetch_array($query);
  $password=$row["Password"];
  $email=$row["Email_Address"];
  $subject="Reset Password";
  $headers = "From: ".$email;
  $content="your password is ".$password;
  mail($email, $subject, $content, $header);
  print "An email containing the password has been sent to you";
    }
  else 
    {
    echo("no such login in the system. please try again.");
    }
  }
?>
<head>
  <meta charset="UTF-8">
  <title>DentalApp - Recover Password</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="forgotPassword.php"><i class="fa fa-refresh"></i></a> 
</div>

    <div class="wrapper">
    <form class="form-signin" action="<?php $_SERVER['PHP_SELF'];?>" method="post">       
      <center><h2 class="form-signin-heading">Logo</h2></center>
      <label>To recover your password, send a link to the email address associated with your account</label> 
      <input type="email" class="form-control" name="email" placeholder="Email Address" required="" autofocus=""  /> <br>  
      <input type="submit" name="submit_email" class="btn btn-info btn-block" value="Send Link">
    </form>
  </div>
  ​<div class="footer">
</div>
</body>
</html>
