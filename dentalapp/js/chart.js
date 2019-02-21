/*var svg = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom;

var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
    y = d3.scaleLinear().rangeRound([height, 0]);

var g = svg.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var xAxis = d3.axisBottom(x);
var yAxis = d3.axisLeft(y);
  
d3.json("../test.php").then( data => {
    console.log(data);


  // Define Extent for each Dataset
   
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



/*function linearRegression(y,x){

  var lr = {};
  var n = y.length;
  var sum_x = 0;
  var sum_y = 0;
  var sum_xy = 0;
  var sum_xx = 0;
  var sum_yy = 0;

  for (var i = 0; i < y.length; i++) {

      sum_x += x[i];
      sum_y += y[i];
      sum_xy += (x[i]*y[i]);
      sum_xx += (x[i]*x[i]);
      sum_yy += (y[i]*y[i]);
  } 

  lr['slope'] = (n * sum_xy - sum_x * sum_y) / (n*sum_xx - sum_x * sum_x);
  lr['intercept'] = (sum_y - lr.slope * sum_x)/n;
  lr['r2'] = Math.pow((n*sum_xy - sum_x*sum_y)/Math.sqrt((n*sum_xx-sum_x*sum_x)*(n*sum_yy-sum_y*sum_y)),2);

  return lr;

};

var yval = data.map(function (d) { return parseFloat(d.value); });
var xval = data.map(function (d) { return parseFloat(d.age_group); });


var lr = linearRegression(yval,xval);

//var known_y = [1, 2, 3, 4];
//var known_x = [5.2, 5.7, 5.0, 4.2];

//var lr = linearRegression(known_y, known_x);
// now you have:
// lr.slope
// lr.intercept
// lr.r2
console.log(lr);


var max = d3.max(data, function (d) { d.value; });
 svg.append('line')
            .attr("x1", x(0))
            .attr("y1", y(lr.intercept))
            .attr("x2", x(max))
            .attr("y2", y( (max * lr.slope) + lr.intercept ))
            .style("stroke", "black")
            .style("stroke-width", 10);

     /*       svg.append('line')
    .style("stroke", "lightgreen")
    .style("stroke-width", 10)
    .attr("x1", 0)
    .attr("y1", 0)
    .attr("x2", 200)
    .attr("y2", 200); */
// });
var margin = {top: 30, right: 30, bottom: 50, left: 50},
width = 450 - margin.left - margin.right,
height = 450 - margin.top - margin.bottom;

var svg = d3.select(".chart").append("svg")
  .attr("width", width + margin.left + margin.right)
  .attr("height", height + margin.top + margin.bottom)
.append("g")
  .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

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
.attr("x", (width + (margin.left + margin.right) )/ 2)
.attr("y", 0 + margin.top)
.attr("text-anchor", "middle")
.style("font-size", "12px")
.style("font-family", "sans-serif")
.text("White Composite Fillings between 2013-2016");

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
      
        svg.append("text")
.attr("x", (width + (margin.left + margin.right) )/ 2)
.attr("y", height + margin.bottom-5)
.attr("class", "text-label")
.attr("text-anchor", "middle")
.text("Age");

svg.append("g")
    .attr("class", "y axis")
    .call(yAxis);

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