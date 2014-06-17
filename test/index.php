<?php

if (isset($_GET['addlastname']))
  {
    include 'lastname.html.php';
    exit();
  }

try
{
$pdo = new PDO('mysql:host=localhost;dbname=TEST', 'testuser',
'mypassword');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
$error = 'Unable to connect to the database server.';
include 'error.html.php';
exit();
}

if (isset($_POST['addlastname']))
  {
    try
      {
    $sql = 'INSERT INTO graphs SET
        lastname = :lastname';
        $s= $pdo -> prepare($sql);
        $s->bindValue(':lastname', $_POST['lastname']);
        $s->execute();
      }
    catch (PDOException $e)
      {
	$error = 'Error adding name: ' .$e->getMessage();
	include 'error.html.php';
	exit();
      }
    header('Location: .');
    exit();

}




if (isset($_GET['addfirstname']))
  {
    include 'firstname.html.php';
    exit();
  }

if (isset($_POST['addfirstname']))
  {
    try
      {
    $sql = 'INSERT INTO graphs SET
        firstname = :firstname';
        $s= $pdo -> prepare($sql);
        $s->bindValue(':firstname', $_POST['firstname']);
        $s->execute();
      }
    catch (PDOException $e)
      {
	$error = 'Error adding name: ' .$e->getMessage();
	include 'error.html.php';
	exit();
      }
    header('Location: .');
    exit();
  }


try
{
$pdo = new PDO('mysql:host=localhost;dbname=TEST', 'testuser',
'mypassword');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
$error = 'Unable to connect to the database server.';
include 'error.html.php';
exit();
}



if (isset($_GET['addduedate']))
  {
    include 'duedate.html.php';
    exit();
  }

try
{
$pdo = new PDO('mysql:host=localhost;dbname=TEST', 'testuser',
'mypassword');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
$error = 'Unable to connect to the database server.';
include 'error.html.php';
exit();
}

if (isset($_POST['addduedate']))
  {
    try
      {
    $sql = 'INSERT INTO graphs SET
        duedate = :duedate';
        $s= $pdo -> prepare($sql);
        $s->bindValue(':duedate', $_POST['duedate']);
        $s->execute();
      }
    catch (PDOException $e)
      {
	$error = 'Error adding date: ' .$e->getMessage();
	include 'error.html.php';
	exit();
      }
    header('Location: .');
    exit();
  }



if (isset($_GET['addsubmitted']))
  {
    include 'submitted.html.php';
    exit();
  }


try
{
$pdo = new PDO('mysql:host=localhost;dbname=TEST', 'testuser',
'mypassword');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
$error = 'Unable to connect to the database server.';
include 'error.html.php';
exit();
}


if (isset($_POST['addsubmitted']))
  {
    try
      {
    $sql = 'INSERT INTO graphs SET
        submitted = :submitted';
        $s= $pdo -> prepare($sql);
        $s->bindValue(':submitted', $_POST['submitted']);
        $s->execute();
      }
    catch (PDOException $e)
      {
	$error = 'Error adding date: ' .$e->getMessage();
	include 'error.html.php';
	exit();
      }
    header('Location: .');
    exit();
  }
//while ($row = $result->fetch())
//{
//$list[] = array('id' => $row['id'], 'text' => $row['lastname'], 'text' => $row['firstname'], 'text' => ['duedate'], 'text' => ['submitted'] );
//}
include 'list.html.php';