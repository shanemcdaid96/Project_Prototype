$(document).ready(function() {
    $('input:radio[name=treatment]').change(function() {
      var choice;
        if (this.value == 'denture') {
       choice=this.value;
        }
        else if (this.value == 'crown') {
          choice=this.value;
        }
        else if (this.value == 'exam') {
          choice=this.value;
        }
        else if (this.value == 'filling') {
          choice=this.value;
        }
        $("#chart").html("");   
        Chart(choice);

    });
});



function Chart(choice){
var urli="trend4.php?choice="+choice;  
var	margin = {top: 10, right: 30, bottom: 150, left: 60},
	width = 500 - margin.left - margin.right,
	height = 360 - margin.top - margin.bottom;
// set the ranges
var x = d3.scaleBand()
          .range([0, width])
          .padding(0.1);
var x0 = d3.scaleOrdinal();
var y = d3.scaleLinear()
          .range([height, 0]);

var color = d3.scaleOrdinal()
    .range(["#ca0020","#f4a582","#d5d5d5","#92c5de","#0571b0"]);          
          

var svg4 = d3.select("#chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", 
          "translate(" + margin.left + "," + margin.top + ")");

///retrieve data from the specified php file and convert it to JSON format
d3.json(urli, function(error, data) {
    console.log(data);
  if (error) throw error;

  // format the data
  data.forEach(function(d) {
    d.price = +d.price;
  });
  
  
  var practiceNames = data.map(function(d) { return d.practice; });
  // Scale the range of the data in the domains
  x0.domain(practiceNames);
  x.domain(data.map(function(d) { return d.treatment; }));
  y.domain([0, d3.max(data, function(d) { return d.price; })]);

  var tooltip = d3.select("#chart").append("div")
    .attr("class", "tooltip")
    .style("opacity", 0);

// tooltip mouseover event handler
var tipMouseover = function(d) {
    var html  = "<p>Price: "+d.price+"</p>";

    tooltip.html(html)
        .style("left", (d3.event.pageX + 30) + "px")
        .style("top", (d3.event.pageY - 50) + "px")
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

  // append the rectangles for the bar chart
  svg4.selectAll(".bar")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.treatment); })
      .style("fill", function(d) { return color(d.practice) })
      .attr("width", x.bandwidth())
      .attr("y", function(d) { return y(d.price); })
      .attr("height", function(d) { return height - y(d.price); })
      .on("mouseover", tipMouseover)
      .on("mouseout", tipMouseout);


  // add the x Axis
  svg4.append("g")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x))
      .selectAll("text")
    .attr("y", 0)
    .attr("x", 9)
    .attr("dy", ".35em")
    .attr("transform", "rotate(90)")
    .style("text-anchor", "start");

      svg4.append("text")             
      .attr("transform",
            "translate(" + (width/2) + " ," + 
                           (height + margin.top + 160) + ")")
      .style("text-anchor", "middle")
      .text("Treatments");
      

  // add the y Axis
  svg4.append("g")
      .call(d3.axisLeft(y));

      svg4.append("text")
  .attr("transform", "rotate(-90)")
  .attr("y", 0 - margin.left)
  .attr("x",0 - (height / 2))
  .attr("dy", "1em")
  .style("text-anchor", "middle")
  .text("Price €"); 

      

    
      var listPractices = d3.set(data.map(function(d){ return d.practice})).values();
      var legend = svg4.selectAll(".legend")
    .data(listPractices)
    .enter().append("g")
      .attr("class", "legend")
      .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; })
      .style("font", "12px sans-serif");

  legend.append("rect")
      .attr("x", width-65)
      .attr("width", 15)
      .attr("height", 15)
      .attr("fill", color);

  legend.append("text")
      .attr("x", width -45)
      .attr("y", 12)
      .attr("dy", "1em")
      .attr("text-anchor", "start")
      .text(function(d,i){ return listPractices[i]});
});

}