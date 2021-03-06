<!DOCTYPE html>
<html lang="en" >
<?php
include("auth.php");
?>

<head>
  <meta charset="UTF-8">
  <title>DentalApp - Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">


      <script type="text/javascript">
$(window).load(function() {
    $('#myModal').modal('show');
});
</script>

<?php  $_SESSION["dob"]; 
            //Minus the current date from the user's date of birth to get the user's age
            $diff = (date('Y') - date('Y',strtotime($_SESSION["dob"])));
            $diff;
              ?>
  
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
<h4>Logged In As: <?php echo $_SESSION['firstname'] ,' ',$_SESSION['surname']  ?></h4>
</div>
<div id="myModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">**ALERT**</h4>
     </div>
     <div class="modal-body">
<?php
//get trend alerts where the user's age resides in the alert's age group
  $sql3=$conn->prepare("SELECT * FROM trend_alerts WHERE min_age <= ? AND max_age >= ?");
  $sql3->bind_param("ss", $diff,$diff);
  $sql3->execute();
  $result=$sql3->get_result();
$i=1;
if ($result->num_rows > 0) {
 // output data of each row 
 while($row=$result->fetch_assoc()) {

      
   echo "<p> ".$i." : ". $row['message']. "</p><hr>";   
  $i++;
 }
} else {
   echo "There is currently no dental news trending in your age bracket";
}
?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

<div id="wrapper" class="toggled">

<!-- Sidebar -->
<?php include("patient-sidebar.php"); ?>
 <div class="wrapper">
    <form class="form-signin">       
    <center><img src="logo.png" width="300" height="200"><br>
    <h3 class="form-signin-heading">Menu - Patient</h3></center> 
      <a href="bookappointments.php"><button class="btn btn-lg btn-primary btn-block" type="button">Appointments</button></a><br> 
     <a href="services.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Services</button></a><br> 
      <a href="logout.php"> <button class="btn btn-lg btn-primary btn-block" type="button">Log Out</button></a><br> 
    </form>
  ​<div class="footer">
</div>
</div>
  

</body>
<script type="text/javascript" src="js/menutoggle.js"></script>
</html>
