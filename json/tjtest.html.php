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

<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts-more.js"></script>

<div id = "graph" style = "width:100%; height:90%;"></div>
<script type = "text/javascript">

	var id_array = <?php echo json_encode($idarray, JSON_PRETTY_PRINT) ?>;
	var on_time_array = <?php echo json_encode($ontimearray, JSON_PRETTY_PRINT) ?>;

$(function() {
	     $('#graph').highcharts( {
	     			     chart: {
				     	    type: 'line'
					    	 },
					title: {
					       text: 'Test Action Items'
					       },
					 xAxis: {
					 	type: 'category',
						categories: eval(id_array),
						title: {
							text: 'AI Number'
							}
						},
					
					yAxis: {
					       type: 'linear',
					       title: {
					       	      text: 'On Time or Not'
						      },
						plotLines: [ {
							   color: 'green',
							   width: 2,
							   value: 5
							   } ]
						},
						
						series: [ {
								name: 'TJ test',
								data: eval('[ + on_time_array + ']')
								} ]
								});
								});
</script>

