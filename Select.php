<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel='stylesheet' href='styles.css' type='text/css' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <title>Query</title>
  </head>
  <body style="background-image:url('carousel.jpg');  background-size: 100%; text-align: center">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Ahoosement Park</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="ActionPageAdmin.html">Home</a></li>
        <li><a href="Select.php">Find</a></li>
        <li><a href="Update.php">Update</a></li>
        <li><a href="Insert.php">Insert</a></li>
        <li><a href="Delete.php">Delete</a></li>
        <li><a href="index.html">Sign Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div id="content-container" class="container-fluid" style="align-content: center">
    <div class="row">
        <div class="col-sm-12 jumbotron"
             style=" background-color: white; max-width: fit-content; float: none; margin: 0 auto;">

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
    <h1>Select from Database</h1>
    <!-- this is the section to display the topic -->
    <?php
    session_start();
    echo 'The topic you selected was ';
    echo $_SESSION["Topic"];
    ?>
    <br>
    <br>
    <p>Fill out this form with the values you would like to query on for each field.  </p>
    <p>If you do not input any values into the fields, submitting will return all of the data for this topic.</p>
    <!-- this section dynamically titles the form -->
    <?php
    echo "<form action='SelectQuery.php' method='post'>";
    foreach ($_SESSION['columns'] as $value) {
      $id = $value . 'ID';
      echo "$value: <br>";
      echo "<select name='$id'>";
      echo "<option value='='> = </option>";
      echo "<option value='>'> > </option>";
      echo "<option value='<'> < </option>";
      echo "</select>";
      echo "<input type='text' name=$value>";
      echo "<br>";
    }
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
       
</div>
    </div>
</div>
 </body>
</html>