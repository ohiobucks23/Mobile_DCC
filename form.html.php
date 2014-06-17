<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add Things</title>
<style type="text/css">
textarea {
display: block;
width: 100%;
}
</style>
</head>
<body>
<form action="?" method="post">

<div>
<label for="lastname">Type your last name here:</label>
<textarea id="lastname" name="lastname" rows="3" cols="3"> </textarea>
  <div><input type="submit" value="Add"></div>
</div>

<p>

<div>
<label for = "firstname"> Type your first name here: </label>
<textarea id = "firstname" name = "firstname" rows="3" cols="3"> </textarea>
</div>

</p>

<div><input type="submit" value="Add"></div>

<div>
  <label for = "duedate"> When is the action item due? </label>
  <textarea id = "duedate" name = "duedate" rows="3" cols = "3">
  </textarea>
   <div><input type="submit" value="Add"></div>
  </div>

  <div>
    <label for = "submitted"> When was this submitted? </label>
    <textarea id = "submitted" name = "submitted" rows="3" cols = "3">
    </textarea>
     <div><input type="submit" value="Add"></div>
    </div>
  

</form>
</body>
</html>