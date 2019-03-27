<!DOCTYPE html>
<html>
  <head>
    <link rel='stylesheet' href='styles.css' type='text/css' />
    <meta charset="UTF-8">
    <title>Query</title>
  </head>
  <body>
    <?php
    session_start();
    echo 'hello';
    echo $_SESSION["Topic"];
    ?>
    <p>This form links to GetColumns.php where it gets the columns based on the topic you selected on the previous page.  This information should end up being used for the column names that you see underneath this.</p>
    <form action="GetColumns.php" method="post">
        <p><input type="submit" /></p>
    </form>
    <h1>Select from Database</h1>
    <form action="GetColumns.php">
      First Col:<br>
      <input type="text" name="firstCol" value="">
      <br>
      Second Col:<br>
      <input type="text" name="secondCol" value="">
      <br>
      Third Col:<br>
      <input type="text" name="thirdCol" value="">
      <br><br>
      <input type="submit" value="Submit">
    </form> 
    <p>This form should allow the user to give input to the attributes from the table and then use the inputs for queries to return information.  Also need to add functionality for greater than, less than, and equal to selection</p>
<!-- <?php
	// session_start();
 //  echo '<h1>hello</h1>';
 //  echo '<p>$_SESSION["Topic"]</p>';
 //  echo $_SESSION["Topic"];
 //  echo $_SESSION["QueryTopic"];
	// echo '<h1>$_SESSION["Topic"]</h1>';
  ?> -->
    </body>
</html>