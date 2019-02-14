<!DOCTYPE html>
<html lang="en" >
<?php
//include("auth.php");
?>

<head>
<style>
  .bar {
  fill: #71EEB8;
}

.bar:hover {
  fill: slateblue;
}

.axis-x path {
  display: none;
}

.axis text {
  font-weight: bold;
}

</style>

  <meta charset="UTF-8">
  <title>DentalApp - Chart</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">
   <!--   <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js"></script> -->
      <script src="https://d3js.org/d3.v5.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.25.0/babel.min.js"></script>

  
</head>

<body>
	<div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="home.php"><i class="fa fa-refresh"></i></a> 

</div>     
      <center><h2 class="form-signin-heading">Dataset Test</h2></center>     
  <svg width="1000" height="500"></svg>
<div class="tooltip"></div>


<div>
  ​<div class="footer">
</div>
</body>
<script>
         /* d3.json("test.php", function(data) {
        console.log(data);
   });*/
   const svg     = d3.select("svg"),
      margin  = {top: 20, right: 20, bottom: 30, left: 50},
      width   = +svg.attr("width")  - margin.left - margin.right,
      height  = +svg.attr("height") - margin.top  - margin.bottom,
      x       = d3.scaleBand().rangeRound([0, width]).paddingInner(0.2),
      y       = d3.scaleLinear().rangeRound([height, 0]),
      g       = svg.append("g")
                   .attr("transform", `translate(${margin.left},${margin.top})`);
                //   https://codepen.io/blackjacques/pen/YJNqyG.html
d3.json("test.php").then( data => {
 // data = data.RECORDS;
  //var rainbow = d3.scaleSequential(d3.interpolateRainbow).domain([0,d3.sum(data, d => 1)]);
  
  x.domain(data.map(d => d.age_group));
  y.domain([0, d3.max(data, d => d.value)]);

  g.append("g")
      .attr("class", "axis axis-x")
      .attr("transform", `translate(0,${height})`)
      .call(d3.axisBottom(x));

  g.append("g")
      .attr("class", "axis axis-y")
      .call(d3.axisLeft(y).ticks(10).tickSize(8));
  
  g.selectAll(".bar")
    .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", d => x(d.age_group))
      .attr("y", d => y(d.value))
      .attr("width", x.bandwidth())
      .attr("height", d => height - y(d.value));
      //.attr("fill", (d,i) => rainbow(i));
})
.catch(err => {
  svg.append("text")         
        .attr("y", 20)
        .attr("text-anchor", "left")  
        .style("font-size", "20px") 
        .style("font-weight", "bold")  
        .text(`Couldn't open the data file: "${err}".`);
});
      </script>

</html>
