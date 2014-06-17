<!DOCTYPE html>
<meta charset="utf-8">
<style>

body {
  font: 20px sans-serif;
}

path {
     stroke: black;
     stroke-width: 2;
     fill: none;
     }

.axis path,
.axis line {
  fill: none; //adds solid black line to axes
  stroke: red; //makes tick marks on x axis red and line on y axis red
  stroke-width: 1;
  shape-rendering: crispEdges;
}

.x.axis path {
  display: yes; //shows x axis if yes; no axis if "none"
}

.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 1.5px;
}

</style>
<body>
<script type = "text/javascript" src="http://d3js.org/d3.v3.js"></script>
<script>

var margin = {top: 30, right: 20, bottom: 60, left: 110},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;



var x = d3.scale.linear()

//.domain([0,30]);
.range([0, width]);

var y = d3.scale.linear()

//.domain([0,3]);
.range([height, 0 ]);

var xAxis = d3.svg.axis()

//.scale([0,20])
.scale(x)
.ticks(20)
    .orient("bottom");

var yAxis = d3.svg.axis()

//.scale([0,3])
.scale(y)
.ticks(3)
.orient("left");

var line = d3.svg.line()
    //different options here...:.interpolate("basis")
    .x(function(d) { return x(d.id); })
    .y(function(d) { return y(d.OnTime); });

var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.json("data.php", function(error, data) {
  data.forEach(function(d) {
    d.id = +d.id;
    d.OnTime = +d.OnTime;
  });

  x.domain(d3.extent(data, function(d) { return d.id; }));
  y.domain([0,3]);//{ return d.OnTime; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

svg.append("text")
.attr("x", width / 2)
.attr("y",height + margin.bottom)
.style("text-anchor", "middle")
.style("font-size", "30px")
.text("Action Item Number");

svg.append("text")
.attr("x",(width/2))
.attr("y", 0 - (margin.top/10))
.attr("text-anchor", "middle")
.style("font-size","30px")
.style("text-decoration","bold")
.text("TJ Schuster's Action Item Performance");

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 0 - (margin.left/1.5))
      .attr("x", 0 -(height/2))
      .attr("dy", ".71em")
      .style("text-anchor", "middle")
      .style("font-size","30px")
      .text("2 = On Time; 1 = Late");

  svg.append("path")
      .datum(data)
      .attr("class", "line")
      .attr("d", line);
});

</script>

<?php

$mysqli = new mysqli('localhost', 'testuser', 'mypassword', 'TEST');

if ($mysqli->connect_errno > 0) 
{
	die('Unable to connect to database [' . $db->connect_error . ']');
}


$query = "SELECT * FROM goodstudent";


if($result = $mysqli->query($query))
 
{
   
while ($row = $result->fetch_assoc())
	 
  {
    echo '<br />';
    echo '<br />';
    $id = $row['id'];
    echo $row['id'] . ':--------------------';
	   echo $row['duedate'] . '------------';
	   echo $row['submitted']. '   ' . '-------------------------------';
	   
	   if ($row['duedate'] > $row['submitted'])
	     {
	       echo "ONTIME";
	       mysqli_query($mysqli,"UPDATE goodstudent SET OnTime = 2 WHERE id = '$id' ");
	     }

	   elseif ($row['duedate'] < $row['submitted'])	     
	     {
	      echo "LATE";
	      mysqli_query($mysqli,"UPDATE goodstudent SET OnTime = 1 WHERE  id = '$id'");
	     }
	  	   
	   echo '<br />';
	   
	   
  } 
echo '<br />';

//echo "<a href = good_student_graph.html> Click to view a graph of student performance</a>";
 

}


?>


 
</body>
