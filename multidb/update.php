
<?php

//This script queries the database and gets all values from the graphs table and checks to see whether the student completed their action item on time
//Author: TJ Schuster
//Last Updated: 


//declaring mysqli object and connecting to database: ('host name', 'username', 'password', 'db name')

$mysqli = new mysqli('localhost', 'testuser', 'mypassword', 'TEST');

//checking to see if connection was good....if not print out what the error was

if ($mysqli->connect_errno > 0) 
{
	die('Unable to connect to database [' . $db->connect_error . ']');
}

//query the database to select all information from the table titled graphs

$query = "SELECT * FROM graphs";

//if this value is true, enter the while loop
//basically, if the query is successful, go into the while loop and fetch the data

if($result = $mysqli->query($query))
 
{

  //While the data is still being gathered, it is stored in the $row array
   
while ($row = $result->fetch_assoc())
	 
  {
    //declaring new variable that will be set to the current row id every time it goes through the while loop
	  
    $id = $row['id'];
    //printing out the data from the table
    echo $row['id'] . ':--------------------';
	   echo $row['duedate'] . '------------';
	   echo $row['submitted']. '   ' . '-------------------------------';
	  
	   //updating the OnTime column that will eventually be the y-axis data for the graph
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
	   
	   
  }

echo '<br />';

//adds link to bottom of the page to direct user to the graph

echo "<a href = attempt_at_json_from_php.html> Click to view a graph of student performance</a>";
 
}


?>


 