<?php

$mysqli = new mysqli('localhost', 'testuser', 'mypassword', 'TEST');

if ($mysqli->connect_errno > 0) 
{
	die('Unable to connect to database [' . $db->connect_error . ']');
}

$myquery = "SELECT id, OnTime FROM graphs";

if($result = $mysqli->query($myquery))

  {

$data = array();

for ($x = 0; $x < mysqli_num_rows($result); $x++)
  
  {
    $data[] = mysqli_fetch_assoc($result);
  }

echo json_encode($data,JSON_PRETTY_PRINT);

  }

?>

