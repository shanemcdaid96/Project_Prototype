<!DOCTYPE html>
<html lang="en" >
<?php
require('../config.php');
include("authDentist.php");
error_reporting(0);
ini_set('display_errors', 0);
if (isset($_REQUEST['newpassword'])){
  // removes backslashes


  $newpassword = stripslashes($_REQUEST['newpassword']);
  $newpassword = mysqli_real_escape_string($conn,$newpassword);
  $confirmnewpassword = stripslashes($_REQUEST['confirmnewpassword']);
  $confirmnewpassword = mysqli_real_escape_string($conn,$confirmnewpassword);

   if( $newpassword != $confirmnewpassword ){
    echo '<script> alert("Change Failed - Passwords do not match!!");';
    echo '</script>';
   }else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $newpassword) === 0){
    echo '<script> alert("Change Failed - Passwords do not meet password requirements!!");';
    echo '</script>';
   }
   else{        
      //  $query ="UPDATE dentists SET Password ='".md5($newpassword)."' WHERE Dentist_Id='".$_SESSION[dID]."' ";
     // $query = "UPDATE patients SET Password ='".md5($newpassword)."' WHERE Email_Address LIKE '%$_POST[patients]%' OR Id LIKE '%$_POST[patients]%' AND Password='".md5($password)."'";
      //  $result = mysqli_query($conn,$query);
      $stmt = $conn->prepare("UPDATE patients SET Password =? WHERE Email_Address LIKE ? OR Id LIKE ? AND Password=?");
      $search1 = '%'.$_POST['patient'].'%';
			$search2 = $_POST['patient'].'%';
      $stmt->bind_param("ssis",md5($newpassword),$search1,$search2,md5($password));
      $result=$stmt->execute();
           if($result){
            echo '<script> alert("Password Change Successful");';
            echo 'window.location.href = "home.php";';
            echo '</script>';
            }


    } 
}  
?>
<head>
  <meta charset="UTF-8">
  <title>Dental Password Change (Patient)</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="../css/style.css">
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <meta charset="UTF-8">

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="changePatientPassword.php"><i class="fa fa-refresh"></i></a> 
  <a href="javascript:history.back(1)"><i class="fa fa-step-backward"></i></a>
</div>

    <div class="wrapper">
    <form class="form-signin" action="" method="POST" >       
    <center><h2 class="form-signin-heading"><img src="../logo.png" width="150" height="150"></h2></center>
    <label>Search Patient</label>
    <input type='text' class='form-control' name='patients' id='patients' autocomplete='off' placeholder='Search by ID or Email Address' required=""/><br>
    <label>Patient</label>
    <div id='patientResult' name='patientResult'></div><br>    
      
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
<script type="text/javascript" src="../js/scriptDentist.js"></script>