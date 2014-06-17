<?php

$mysqli = new mysqli('localhost', 'testuser', 'mypassword', 'TEST');

if ($mysqli->connect_errno > 0) 
{
	die('Unable to connect to database [' . $db->connect_error . ']');
}


$query = "SELECT * FROM graphs";

mysqli_query ($mysqli, "SELECT id, OnTime INTO OUTFILE '/Users/TJ/desktop/WORK.csv' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM graphs");

if($result = $mysqli->query($query))
 
{
   
while ($row = $result->fetch_assoc())
	 
  {
	  
    $id = $row['id'];
    echo $row['id'] . ':--------------------';
	   echo $row['duedate'] . '------------';
	   echo $row['submitted']. '   ' . '-------------------------------';
	   
	   if ($row['duedate'] > $row['submitted'])
	     {
	       echo "ONTIME";
	       mysqli_query($mysqli,"UPDATE graphs SET OnTime = 2 WHERE id = '$id' ");
	     }

	   elseif ($row['duedate'] < $row['submitted'])	     
	     {
	      echo "LATE";
	      mysqli_query($mysqli,"UPDATE graphs SET OnTime = 1 WHERE  id = '$id'");
	     }
	  	   
	   echo '<br />';
	   
	   
  } //end of while loop

}


/*$second = "SELECT id, OnTime FROM graphs";

if($redo = $mysqli->query($second))
 
{
   $fp = fopen('/Users/TJ/desktop/file.csv', 'w');

   while ($check = $redo->fetch_assoc())
     {
       fputcsv($fp, $check);
     }
 }

fclose($fp);
*/





//mysqli_query ($mysqli, "SELECT id, OnTime INTO OUTFILE '/pat/products.csv' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM graphs");



?>
 