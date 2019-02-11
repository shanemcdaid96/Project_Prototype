<!DOCTYPE html>
<html lang="en" >
<?php
//include("auth.php");
?>

<head>
<style>
body {
    background-color:white;
    font: 10px sans-serif;
}

.axis path,
.axis line {
    fill: none;
    stroke: #000;
    shape-rendering: crispEdges;
}

.area {
    fill: steelblue;
}
</style>

  <meta charset="UTF-8">
  <title>DentalApp - Chart</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">
      <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js"></script>

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="home.php"><i class="fa fa-refresh"></i></a> 

</div>

    <div class="wrapper">
    <form class="form-signin">       
      <center><h2 class="form-signin-heading">Denture Repairs Between 2013-2016</h2></center>     
      <script>
          d3.json("test.php", function(root) {
        console.log(root.Age);
             });
      </script>
         <div id="graph">
        

        </div>

    </form>
  </div>
  ​<div class="footer">
</div>
  
  

</body>

</html>
