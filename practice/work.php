<?php

$mysqli = new mysqli('localhost', 'testuser', 'mypassword', 'TEST');

if ($mysqli->connect_errno > 0) 
{
  $result = mysqli_query($mysqli, 'SELECT * FROM graphs');
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $fp = fopen('file.csv','w');
  
  foreach ($row as $val)
    {
      fputcsv($fp, $val);
    }

  echo "File created";

  fclose($fp);

