<!DOCTYPE html>
<meta charset="utf-8">
<style>

.bar {
  fill: steelblue;
}

.bar:hover {
  fill: brown;
}

.axis--x path {
  display: none;
}

</style>
<svg width="960" height="500"></svg>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>

var svg = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom;

var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
    y = d3.scaleLinear().rangeRound([height, 0]);

var g = svg.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var xAxis = d3.axisBottom(x);
var yAxis = d3.axisLeft(y);
  
d3.json("test.php").then( data => {
 // d.frequency = +d.frequency;


  // Define Extent for each Dataset
  //x.domain(data.map(function(d) { return d.letter; }));
 // y.domain([0, d3.max(data, function(d) { return d.frequency; })]);
   
 x.domain(data.map(d => d.age_group));
  y.domain([0, d3.max(data, d => d.value)]);

  // Add Axes
  // X AXIS
  g.append("g")
      .attr("class", "axis axis--x")
      .attr("transform", "translate(-16," + height + ")")
      .call(xAxis);
  // Y AXIS
  g.append("g")
      .attr("class", "axis axis--y")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", "0.71em")
      .attr("text-anchor", "end")
      .text("Value");

  g.selectAll(".bar")
    .data(data)
    .enter().append("circle")
      .attr("class", "bar")
      .attr("cx", d => x(d.age_group))
      .attr("cy", d => y(d.value))
      .attr('r', 3)
      .attr("width", x.bandwidth())
      .attr("height", d => height - y(d.value));
//       .attr("width", x.bandwidth())
//       .attr("height", function(d) { return height - y(d.frequency); });
});

</script>