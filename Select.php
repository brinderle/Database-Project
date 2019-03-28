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
    <h1>Select from Database</h1>
    <!-- this is the section to display the topic -->
    <?php
    session_start();
    echo 'The topic you selected is ';
    echo $_SESSION["Topic"];
    echo '<br>';
    ?>
    <!-- this section dynamically titles the form -->
    <?php
    echo "<form action='SelectQuery.php'>";
    foreach ($_SESSION['columns'] as $value) {
      echo "$value: <br>";
      echo "<input type='text' name=$value>";
      echo "<br>";
    }
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
    ?>
    <p>This form should allow the user to give input to the attributes from the table and then use the inputs for queries to return information.  Also need to add functionality for greater than, less than, and equal to selection</p>
    </body>
</html>