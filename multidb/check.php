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

var margin = {top: 30, right: 50, bottom: 60, left: 110},
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
.ticks(10)
    .orient("bottom");

var yAxis = d3.svg.axis()

//.scale([0,3])
.scale(y)
.ticks(3)
.orient("left");

var line = d3.svg.line()
    //different options here...:.interpolate("basis")
    .x(function(d) { return x(d.user_id); })
    .y(function(d) { return y(d.ontime); });

var div = d3.select("body").append("div")
    .attr("class", "tooltip")
    .style("opacity",0);

var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.json("json_data.php", function(error, data) {
  data.forEach(function(d) {
    d.user_id = +d.user_id;
    d.ontime = +d.ontime;
  });

  x.domain(d3.extent(data, function(d) { return d.user_id; }));
  y.domain([0,3]);//{ return d.OnTime; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

/* svg.selectAll("dot")
     .data(data)
.enter().append("circle")
     .attr("r",2)
     .attr("cx",function(d) {return x(d.id); })
     .attr("cy", function(d) {return y(d.OnTime);});
 Adds dots to the line*/

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

//checking to see if connection was good....if not print out what the error was

if ($mysqli->connect_errno > 0) 
{
	die('Unable to connect to database [' . $db->connect_error . ']');
}

//query the database to select all information from the table titled graphs

$query = "SELECT * FROM action_items";

//if this value is true, enter the while loop
//basically, if the query is successful, go into the while loop and fetch the data

if($result = $mysqli->query($query))
 
{

  
    echo '<br />';
    echo '<br />';

  //While the data is still being gathered, it is stored in the $row array
   
while ($row = $result->fetch_assoc())
	 
  {

    $id = $row['row_id'];

    if ($row['deadline'] > $row['submitted'])
      {
	echo "ONTIME";
	mysqli_query($mysqli, "UPDATE action_items SET ontime = 2 WHERE row_id = '$id'");
      }

    elseif ($row['deadline'] < $row['submitted'])
      {
	echo "LATE";
	mysqli_query($mysqli, "UPDATE action_items SET ontime = 1 WHERE row_id = '$id'");
      }
    
    echo '---------';

    echo 'Deadline: ' . $row['deadline'] . '----';
    echo 'Sent: ' . $row['sent'] . '----';
    echo 'Submitted: ' . $row['submitted'] . '---';
    

    $sub_time = $row['submitted'];
    $final_sub_time = strtotime($sub_time);
    echo $final_sub_time. '----';
    
    $sent_time = $row['sent'];
    $final_sent_time = strtotime($sent_time);
    echo $final_sent_time . '-----';
   
    $difference = $final_sub_time - $final_sent_time;
    echo $difference . '-----';
    $minutes = $difference / 60;
    $hours = $minutes / 60;
    echo $hours;
    
    if($row['ontime'] == '2')
      {
	mysqli_query($mysqli, "UPDATE action_items SET hours = '$hours' WHERE row_id = '$id'");
      }
    elseif($row['ontime'] == '1')
      {
	mysqli_query($mysqli, "UPDATE action_items SET hours = 0 WHERE row_id = '$id'");
      }

	
    echo '<br />';
    
  }
}

?>

</body>