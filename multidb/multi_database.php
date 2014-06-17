<!DOCTYPE html>

<html>
<body>

<form action = "update.php" method = "post">
<select name = "names">

<?php 

   $mysqli = new mysqli('localhost','testuser','mypassword','TEST');


if ($mysqli->connect_errno > 0) 
{
	die('Unable to connect to database [' . $db->connect_error . ']');
}

  $myquery = "SELECT firstname, lastname FROM users";

if ($result = $mysqli->query($myquery))
  
  {

    while ($data = mysqli_fetch_assoc($result))
      {
	echo "<option value = 'ID'>" .  $data['lastname'] . ', ' . $data['firstname'] . "</option>";
	}
      }

echo " ". " ".  "<input type = 'submit' value = 'SUBMIT'>  </input>";

if(isset($_POST['names']))
  {
    echo "<option>" . 'HELLO' . "</option>";
  }

      ?>

</select>
  
</form>
</body>
</html>
