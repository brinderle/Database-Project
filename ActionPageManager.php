<!DOCTYPE html>
<html lang="en">
  <?php
  session_start();
  if ($_SESSION['role'] != 'employee') {
    header( 'Location: index.html');
    break;
  }
  ?>
  <head>
    <link rel='stylesheet' href='styles.css' type='text/css' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <title>Query</title>
  </head>
  <body>
    <style>
    /* Three image containers (use 25% for four, and 50% for two, etc) */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
}

/* Clear floats after image containers */
.row::after {
  content: "";
  clear: both;
  display: table;
  height:50%;
}
</style>
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
<!-- <div class="row">
    <div class="column">
      <img src="FerrisWheel.jpg" alt="Snow" style="width:100%">
    </div>
    <div class="column">
      <img src="UVArotunda.jpg" alt="Forest" style="width:100%">
    </div>
    <div class="column" style="height:200px">
      <img src="RollerCoaster.jpg" alt="Mountains" style="width:100%">
    </div>
  </div> -->

  <div class ="container-fluid">
    <h1>Query our Database</h1>
   <p style = "text-align: center"> Select a topic: </p>
    <form action="RedirectByUserAction.php" method="POST" style="text-align: center">
      <div class="row">
        <input type="radio" id="Topic" name="Topic" value="Attraction"> Attraction <br>
        <input type="radio" id="Topic" name="Topic" value="Park"> Park <br>
        <input type="radio" id="Topic" name="Topic" value="Region"> Region <br>
        <input type="radio" id="Topic" name="Topic" value="Ride"> Ride <br>
        <input type="radio" id="Topic" name="Topic" value="Show"> Show <br>
        <input type="radio" id="Topic" name="Topic" value="Game"> Game <br>
        <input type="radio" id="Topic" name="Topic" value="Shop"> Shop <br>
        <input type="radio" id="Topic" name="Topic" value="Food_Vendor"> Food Vendor <br>
      </div>
        What you would like to do with it?
        </br>
        <input type="radio" id="QueryTopic" name="QueryTopic" value="Insert" > Insert <br>
        <input type="radio" id="QueryTopic" name="QueryTopic" value="Select"> Select <br>
        <input type="radio" id="QueryTopic" name="QueryTopic" value="Update"  > Update <br>
        <input type="radio" id="QueryTopic" name="QueryTopic" value="Delete"> Delete<br>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>  
