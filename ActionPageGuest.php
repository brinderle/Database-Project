<!DOCTYPE html>
<html lang="en">
  <?php
   session_start();
   if ($_SESSION['role'] != 'guest') {
     header( 'Location: index.html');
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
  width: 20%;
  /* padding: 5px; */
}

/* Clear floats after image containers */
.row::after {
  content: "";
  clear: both;
  display: table;
  width:10%;
  height:10%;
} 

.row {
  width:30%;
  margin-left: 33.33%;
}

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
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
      <a class="navbar-brand" href="#">aHOOSment Park</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="ActionPageGuest.php">Home</a></li>
        <li><a href="Select.php">Find</a></li>
        <li><a href="index.html">Sign Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
      <img src="CombinedPicture.jpg" alt="Parks" class="center">


  <div class ="container-fluid">
    <h1>Come learn more about the aHOOSment park!</h1>
   <h4 style = "text-align: center"> Select a topic: </h4>
    <form action="RedirectByUserAction.php" method="POST" style="text-align: center">
      <div class="row">         
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Attraction"> Attraction <br></div>
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Park"> Park <br></div>
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Region"> Region <br></div>
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Ride"> Ride <br></div>
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Show"> Show <br></div>
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Game"> Game <br></div>
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Shop"> Shop <br></div>
        <div class="column"><input type="radio" id="Topic" name="Topic" value="Food_Vendor"> Food Vendor <br></div>
      </div>
      </br>
        <h4>What you would like to do with it?</h4>
        <input type="radio" id="QueryTopic" name="QueryTopic" value="Select"> Select <br>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>  