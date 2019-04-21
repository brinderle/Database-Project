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
    $column_data_types = array();
    // Can substitute out the table name for whatever topic was passed in
    $sql="SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    while($row = mysqli_fetch_array($result)) {
        array_push($columns, $row['COLUMN_NAME']);
        array_push($column_data_types, $row['DATA_TYPE']);
    }
    $_SESSION['columns'] = $columns;
    $_SESSION['column_data_types'] = $column_data_types;
    mysqli_close($con);
?>
    <h1>Update the Database</h1>
    <!-- this is the section to display the topic -->
    <?php
    session_start();
    echo 'The topic you selected was ';
    echo $_SESSION["Topic"];
    ?>
    <br>
    <br>
    <p>Use this first part of the form to input the conditions which you would like to update on.  This is referring to the WHERE clause</p>
    <!-- this section dynamically titles the form -->
    <?php
    echo "<form action='UpdateQuery.php' method='post'>";
    foreach ($_SESSION['columns'] as $value) {
      $select_id = $value . 'SELECT_ID';
      $select_value = $value . 'SELECT';
      echo "$value: <br>";
      echo "<select name='$select_id'>";
      echo "<option value='='> = </option>";
      echo "<option value='>'> > </option>";
      echo "<option value='<'> < </option>";
      echo "</select>";
      echo "<input type='text' name=$select_value>";
      echo "<br>";
    }
    echo "<p>Use this second part of the form to input the values that the selected rows should take on after the update.</p>";
    foreach ($_SESSION['columns'] as $value) {
      $update_id = $value . 'UPDATE_ID';
      $update_value = $value . 'UPDATE';

      echo "$value: <br>";
      echo "<input type='text' name=$update_value>";
      echo "<br>";
    }
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
    ?>
    </body>
</html>