var	margin = {top: 30, right: 20, bottom: 60, left: 60},
	width = 500 - margin.left - margin.right,
	height = 320 - margin.top - margin.bottom;
var svg3 = d3.select("#chart")
    	.append("svg")
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

//d3.csv("../dentist/data.csv",types,function(error, data){
d3.json("../dentist/trend3.php",function(error,data){
y.domain(d3.extent(data, function(d){ return d.value=+d.value}));
x.domain(d3.extent(data, function(d){ return d.age=+d.age}));


// see below for an explanation of the calcLinear function
  var lg = calcLinear(data, "age", "value", d3.min(data, function(d){ return d.age}), d3.min(data, function(d){ return d.value}));
  
      // chart title
      svg3.append("text")
      .attr("x", (width / 2))             
      .attr("y", 0 - (margin.top / 2))
      .attr("text-anchor", "middle")  
      .style("font-size", "16px") 
      .style("text-decoration", "underline")  
      .text("Surgical Extraction 2013-2016");

svg3.append("line")
    .attr("class", "regression")
    .attr("x1", x(lg.ptA.x))
    .attr("y1", y(lg.ptA.y))
    .attr("x2", x(lg.ptB.x))
    .attr("y2", y(lg.ptB.y));

svg3.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
      
  // text label for the x axis
  svg3.append("text")             
      .attr("transform",
            "translate(" + (width/2) + " ," + 
                           (height + margin.top + 20) + ")")
      .style("text-anchor", "middle")
      .text("Age");
svg3.append("g")
    .attr("class", "y axis")
    .call(yAxis);

      // text label for the y axis
  svg3.append("text")
  .attr("transform", "rotate(-90)")
  .attr("y", 0 - margin.left)
  .attr("x",0 - (height / 2))
  .attr("dy", "1em")
  .style("text-anchor", "middle")
  .text("Value"); 

  // Add the tooltip container to the vis container
  // it's invisible and its position/contents are defined during mouseover
  var tooltip = d3.select("#chart").append("div")
      .attr("class", "tooltip")
      .style("opacity", 0);

  // tooltip mouseover event handler
  var tipMouseover = function(d) {
      var html  = "<p>Value: "+d.value+", Age: "+d.age+"</p>";

      tooltip.html(html)
          .style("left", (d3.event.pageX + 15) + "px")
          .style("top", (d3.event.pageY - 28) + "px")
        .transition()
          .duration(200) // ms
          .style("opacity", .9) // started as 0!

  };
  // tooltip mouseout event handler
  var tipMouseout = function(d) {
      tooltip.transition()
          .duration(300) // ms
          .style("opacity", 0); // don't care about position!
  };

svg3.selectAll(".point")
    .data(data)
  .enter().append("circle")
    .attr("class", "point")
    .attr("r", 3)
    .attr("cy", function(d){ return y(d.value); })
    .attr("cx", function(d){ return x(d.age); })
    .on("mouseover", tipMouseover)
    .on("mouseout", tipMouseout);

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
