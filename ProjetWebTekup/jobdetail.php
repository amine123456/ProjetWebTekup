<?php   session_start();
    if(empty($_SESSION['user'])){
      header("Location: index.php?error=notloggedin");
      exit();  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">

    <title>Job detail</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">

  <?php require 'includes/navbar.html' ?>



    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(assets/img/wallhaven-q66kx5.jpg)">
      <div class="container">
        <div class="header-detail">
        <?php 
    $jobid=$_GET['jobid'];
    require 'functions/dbconnect.php';     
    require 'functions/variousfunc.php';

    $sql = "SELECT * FROM job WHERE id=$jobid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo            "<img class=\"logo\" src=\"uploads/job_images/".$row['image']."\" alt=\"\">
        <div class=\"hgroup\">
          <h1>".$row['titre']."</h1>
          <h3><a href=\"".$row['url']."\" target=\"_blank\">".$row['Company']."</a></h3>
        </div>
        <time datetime=\"".$row['publishdate']."\">".time_elapsed_string($row["publishdate"])."</time>
        <hr>
        <p class=\"lead\">".$row['description']."</p>

        <ul class=\"details cols-3\">
          <li>
            <i class=\"fa fa-map-marker\"></i>
            <span>".$row['location']."</span>
          </li>

          <li>
            <i class=\"fa fa-certificate\"></i>
            <span>".$row['contract']."</span>
          </li>

          <li>
            <i class=\"fa fa-money\"></i>
            <span>".$row['salaire']." Dt/ year</span>
          </li>

          <li>
            <i class=\"fa fa-clock-o\"></i>
            <span>".$row['workhours']."h / week</span>
          </li>

          <li>
            <i class=\"fa fa-flask\"></i>
            <span>".$row['experience']." years experience</span>
          </li>

          <li>
            <i class=\"fa fa-briefcase\"></i>
            <a href=\"\">".$row['contacte']."</a>
          </li>
        </ul>
        <div class=\"button-group\">



      </div>
";

  }
  } else {
      echo "0 results";
  }
  $conn->close();
?>


        </div>
      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>


    </main>
    <!-- END Main container -->


    <?php include 'includes/footer.html' ?>

    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>

  </body>
</html>
