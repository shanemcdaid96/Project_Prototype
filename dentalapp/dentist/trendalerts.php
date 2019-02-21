<!DOCTYPE html>
<html lang="en" >
<?php
//include("auth.php");
?>

<head>

  <meta charset="UTF-8">
  <title>DentalApp - Chart</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>

      <link rel="stylesheet" href="../css/style.css">
   <!--   <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js"></script> -->
    <!--  <script src="https://d3js.org/d3.v5.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.25.0/babel.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>



  
</head>

<body>

	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="trendalerts.php"><i class="fa fa-refresh"></i></a> 

</div>     
      <center><h2 class="form-signin-heading">Current Trends</h2></center>   
      <div class="chart"></div>   
  <svg width="1000" height="500"></svg>
  <div class="wrapper">
    <form class="form-signin"> 
    <label for="comment">Create New Trend Alert: </label>
      <textarea class="form-control" rows="5" id="comment" required></textarea><br>
 <div class="age-dropdown"> 
 <label for="comment">Age Group: </label>        
<select  name="sab"  class="req"  id="age-range" style="width:50px; height:30px;" autocomplete="off" required/> </select>
<i class="fa fa-arrows-h" style="font-size:24px"></i>
<select  name="eab"  class="req"  id="second" style="width:50px; height:30px;" autocomplete="off" required/> </select>
</div><br>
<input type='submit' name='submit' class='btn btn-info btn-block' value='Create Alert'>
</form>
</div>
  ​<div class="footer">
</div>
</body>
<script src="../js/chart.js"></script>
<script src="../js/agerange.js"></script>

</html>