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
//echo "<label>**ALERT**</label>";
$sql3 = "SELECT * FROM trend_alerts WHERE min_age <= $diff AND max_age >= $diff";
$result3 = $conn->query($sql3);;
$i=1;
if ($result3->num_rows > 0) {
 // output data of each row 
 while($row3 = $result3->fetch_assoc()) {

      
   echo "<p> ".$i." : ". $row3["message"]. "</p><hr>";   
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
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
    <h4>Settings</h4>
        <li>
            <a href="#">Change User Password</a>
        </li>
        <li>
            <a href="logout.php">Log Out</a>
        </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
 <div class="wrapper">
    <form class="form-signin">       
      <center><h2 class="form-signin-heading"><img src="logo.png" width="150" height="150"></h2></center>     
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
