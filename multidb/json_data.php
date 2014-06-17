<?php

$mysqli = new mysqli('localhost', 'testuser', 'mypassword', 'TEST');

if ($mysqli->connect_errno > 0) 
{
	die('Unable to connect to database [' . $db->connect_error . ']');
}

//This query only selects the two columns that will be used in the making of the graph

$myquery = "SELECT * FROM action_items";

if($result = $mysqli->query($myquery))

  {

    //creates array that will store the values of the id and OnTime column

$data = array();

//for loop that loops through the table until it is at the end of the row

for ($x = 0; $x < mysqli_num_rows($result); $x++)
  
  { //stores data in the data array
    $data[] = mysqli_fetch_assoc($result);
  }

//converts values to JSON objects so that the d3 graph is compatible

echo json_encode($data,JSON_PRETTY_PRINT);

//echo "<a href = update.php> Click here to update the data</a>";


  }
?>