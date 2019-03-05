var margin = {top: 60, right: 60, bottom: 100, left: 100},
width = 700 - margin.left - margin.right,
height = 700 - margin.top - margin.bottom;

var svg = d3.select("#chart").append("svg")
    .classed("svg-container", true)
  .attr("width", width + margin.left + margin.right)
  .attr("height", height + margin.top + margin.bottom)
.append("g")
  .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
  .attr("preserveAspectRatio", "xMinYMin meet")
  .attr("viewBox", "0 0 600 400")
//  class to make it responsive
 .classed("svg-content-responsive", true); 

var x = d3.scaleLinear()
  .range([0,width]);

var y = d3.scaleLinear()
  .range([height,0]);

var xAxis = d3.axisBottom()
  .scale(x);

var yAxis = d3.axisLeft()
  .scale(y);

d3.csv("../dentist/data2.csv", types, function(error, data){

y.domain(d3.extent(data, function(d){ return d.value}));
x.domain(d3.extent(data, function(d){ return d.age}));

// see below for an explanation of the calcLinear function
  var lg = calcLinear(data, "age", "value", d3.min(data, function(d){ return d.value}), d3.min(data, function(d){ return d.value}));
  
      // chart title
      svg.append("text")
      .attr("x", (width / 2))             
      .attr("y", 0 - (margin.top / 2))
      .attr("text-anchor", "middle")  
      .style("font-size", "16px") 
      .style("text-decoration", "underline")  
      .text("White Composite Fillings 2013-2016");

svg.append("line")
    .attr("class", "regression")
    .attr("x1", x(lg.ptA.x))
    .attr("y1", y(lg.ptA.y))
    .attr("x2", x(lg.ptB.x))
    .attr("y2", y(lg.ptB.y));

svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
      
  // text label for the x axis
  svg.append("text")             
      .attr("transform",
            "translate(" + (width/2) + " ," + 
                           (height + margin.top + 20) + ")")
      .style("text-anchor", "middle")
      .text("Age");
svg.append("g")
    .attr("class", "y axis")
    .call(yAxis);

      // text label for the y axis
  svg.append("text")
  .attr("transform", "rotate(-90)")
  .attr("y", 0 - margin.left)
  .attr("x",0 - (height / 2))
  .attr("dy", "1em")
  .style("text-anchor", "middle")
  .text("Value"); 

svg.selectAll(".point")
    .data(data)
  .enter().append("circle")
    .attr("class", "point")
    .attr("r", 3)
    .attr("cy", function(d){ return y(d.value); })
    .attr("cx", function(d){ return x(d.age); });

});

function types(d){
d.age = +d.age;
d.value = +d.value;

return d;
}

// Calculate a linear regression from the data

// Takes 5 parameters:
// (1) Your data
// (2) The column of data plotted on your x-axis
// (3) The column of data plotted on your y-axis
// (4) The minimum value of your x-axis
// (5) The minimum value of your y-axis

// Returns an object with two points, where each point is an object with an x and y coordinate

function calcLinear(data, x, y, minX, minY){
/////////
//SLOPE//
/////////

// Let n = the number of data points
var n = data.length;

// Get just the points
var pts = [];
data.forEach(function(d,i){
  var obj = {};
  obj.x = d[x];
  obj.y = d[y];
  obj.mult = obj.x*obj.y;
  pts.push(obj);
});

// Let a equal n times the summation of all x-values multiplied by their corresponding y-values
// Let b equal the sum of all x-values times the sum of all y-values
// Let c equal n times the sum of all squared x-values
// Let d equal the squared sum of all x-values
var sum = 0;
var xSum = 0;
var ySum = 0;
var sumSq = 0;
pts.forEach(function(pt){
  sum = sum + pt.mult;
  xSum = xSum + pt.x;
  ySum = ySum + pt.y;
  sumSq = sumSq + (pt.x * pt.x);
});
var a = sum * n;
var b = xSum * ySum;
var c = sumSq * n;
var d = xSum * xSum;

// Plug the values that you calculated for a, b, c, and d into the following equation to calculate the slope
// slope = m = (a - b) / (c - d)
var m = (a - b) / (c - d);

/////////////
//INTERCEPT//
/////////////

// Let e equal the sum of all y-values
var e = ySum;

// Let f equal the slope times the sum of all x-values
var f = m * xSum;

// Plug the values you have calculated for e and f into the following equation for the y-intercept
// y-intercept = b = (e - f) / n
var b = (e - f) / n;

// Print the equation below the chart
//	document.getElementsByClassName("equation")[0].innerHTML = "y = " + m + "x + " + b;
//	document.getElementsByClassName("equation")[1].innerHTML = "x = ( y - " + b + " ) / " + m;

// return an object of two points
// each point is an object with an x and y coordinate
return {
  ptA : {
    x: minX,
    y: m * minX + b
  },
  ptB : {
    y: minY,
    x: (minY - b) / m
  }
}

}