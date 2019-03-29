<!DOCTYPE html>
<html>
  <head>
    <link rel='stylesheet' href='styles.css' type='text/css' />
    <meta charset="UTF-8">
    <title>Query</title>
  </head>
  <body>
    <!-- this is the php section to get the column names for the topic and put them in the session array -->
    <?php
    require_once('./library.php');
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD,
    $DATABASE);
    // Check connection
    if (mysqli_connect_errno()) {
        echo("Can't connect to MySQL Server. Error code: " .
        mysqli_connect_error());
        return null;
    }
    // Form the SQL query (a SELECT query)
    
    session_start();
    $table = $_SESSION['Topic'];
    $columns = array();
    // Can substitute out the table name for whatever topic was passed in
    $sql="SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    while($row = mysqli_fetch_array($result)) {
        array_push($columns, $row['COLUMN_NAME']);
    }
    $_SESSION['columns'] = $columns;
    mysqli_close($con);
?>
    <h1>Delete From Database</h1>
    <!-- this is the section to display the topic -->
    <?php
    session_start();
    echo 'The topic you selected was ';
    echo $_SESSION["Topic"];
    ?>
    <br>
    <br>
    <p>Fill out this form with the values you would like to use as criteria to delete.</p>
    <!-- this section dynamically titles the form -->
    <?php
    echo "<form action='DeleteQuery.php' method='post'>";
    foreach ($_SESSION['columns'] as $value) {
      $id = $value . 'ID';
      echo "$value: <br>";
      echo "<input type='radio' id='$id' name='$id' value='='> = <br>";
      echo "<input type='radio' id='$id' name='$id' value='>'> > <br>";
      echo "<input type='radio' id='$id' name='$id' value='<'> < <br>";
      echo "<input type='text' name=$value>";
      echo "<br>";
    }
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
    ?>
    </body>
</html>