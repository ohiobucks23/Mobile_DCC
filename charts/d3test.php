<!DOCTYPE html>
<meta charset = "utf-8">
<style>

body {
font: 10px sans-serif;
}

  .axis path,
  .axis line {
fill: none;
stroke: #000;
  shape-rendering: crispEdges;
}

  .x.axis path {
display:none;
   }

  .line{
fill:none;
stroke: steelblue;
  stroke-width: 1.5px;
   }

</style>
<body>
<script type = "text/javascript" src="http://d3js.org/d3.v3.js"></script>

<script>

<?php

$mysqli = new mysqli('localhost', 'testuser', 'mypassword', 'TEST');

	if ($mysqli->connect_errno > 0)
	   
		{
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	else
		{
			$result = mysqli_query($mysqli, "SELECT id, OnTime FROM graphs");
		}
		
	mysqli_close($mysqli);

$idarray = array();
$ontimearray = array();

$count = 0;


while ($row = mysqli_fetch_array($result))
      
  {
		$idarray[$count] = $row['id'];
		$ontimearray[$count] = $row['OnTime'];
		$count++;
	}

?>

var id_array = <?php echo json_encode($idarray,JSON_PRETTY_PRINT) ?>;
var on_time_array = <?php echo json_encode($ontimearray,JSON_PRETTY_PRINT) ?>;

  var margin = {top: 20, right: 20, bottom: 30, left: 50},
  width = 960 - margin.left - margin.right,
  height = 500 - margin.top - margin.bottom;

var x = d3.scale.linear()

  .range([0,width]);

var y = d3.scale.linear()

  .range([height, 0]);

var xAxis = d3.svg.axis()

  .scale(x)
  .ticks(20)
  .orient("bottom");

  var yAxis = d3.svg.axis()

  .scale(y)
    .ticks(5)
    .orient("left");

    var line = d3.svg.line()
    .x(function(d) { return x(d.id_array);})
    .y(function(d) { return y(d.on_time_array);});

    var svg = d3.select("body").append("svg")
    .data(id_array)
      .data(on_time_array)
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate("+ margin.left + "," + margin.top + ")");

    d3.json("

    x.domain(d3.extent(data,function(d) { return d.id_array; } ));
    y.domain(d3.extent(data, function(d) { return d.on_time_array; } ));

    svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(xAxis);

    svg.append("g")
    .attr("class", "y axis")
    .call(yAxis)
    .append("text")
    .attr("y", 6)
    .attr("dy", ".71em")
    .style("text-anchor","end")
    .text("Price ($)");

    svg.append("path")
    .datum(data)
    .attr("class", "line")
    .attr("d",line);

    });

</script>
</body>



