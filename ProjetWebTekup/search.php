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

    <title>Search</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav bg-alt">

  <?php include "includes/navbar.html" ?>


    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(assets/img/wallhaven-r7z7z1.jpg);">
      <div class="container page-name">
        <h1 class="text-center">Browse jobs</h1>
        <p class="lead text-center">Use following search box to find jobs that fits you better</p>
      </div>

      <div class="container">
        <form action="search.php" method="post">

          <div class="row">
            <div class="form-group col-xs-12 col-sm-4">
              <input type="text" name="searcht" class="form-control" placeholder="Titre">
            </div>

            <div class="form-group col-xs-12 col-sm-4">
              <select name="domaine" class="form-control selectpicker">
                <option value="Domaine Informatique">Domaine Informatique</option>
                <option value="Domaine Design">Domaine Design</option>
                <option value="Domaine Fabrication">Domaine Fabrication</option>
                <option value="Domaine Marketing">Domaine Marketing</option>
                <option value="Autre">Autre</option>
              </select>
            </div>

          </div>

          <div class="button-group">
            <div class="action-buttons">
              <button class="btn btn-primary" name="submit_search">Apply filter</button>
            </div>
          </div>

        </form>

      </div>

    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>
      <section class="no-padding-top bg-alt">
        <div class="container">
          <div class="row">





            <?php 

                require 'functions/variousfunc.php';     

                require 'functions/dbconnect.php';     

                
                $titre=$_POST['searcht'];
                $domaine=$_POST['domaine'];
                if(isset($_POST['submit_search'])){
                    $search=mysqli_real_escape_string($conn,$_POST['searcht']);
                    $sql= "SELECT * FROM job WHERE titre COLLATE UTF8_GENERAL_CI LIKE '%$search%' AND domaine='$domaine'";
                    $result=mysqli_query($conn,$sql);
                    $queryResult=mysqli_num_rows($result);

                    echo "<div class=\"col-xs-12\">
                    <br>
                    <h5>We found <strong>$queryResult</strong> matches</h5>
                  </div>";
                    if ($queryResult >0){
                        while ($row=mysqli_fetch_assoc($result)){
                            echo "<div class=\"col-xs-12\">
                            <a class=\"item-block\" href=\"jobdetail.php?jobid=".$row['id']."\">
                              <header>
                                <img src=\"uploads/job_images/".$row['image']."\" alt=\"\">
                                <div class=\"hgroup\">
                                  <h4>".$row["titre"]."</h4>
                                  <h5>".$row["Company"]."<span class=\"label label-success\">".$row["contract"]."</span></h5>
                                </div>
                                <time datetime=\"".$row["publishdate"]."\">".time_elapsed_string($row["publishdate"])."</time>
                              </header>
              
                              <div class=\"item-body\">
                                <p>".$row["description"]."</p>
                              </div>
              
                              <footer>
                                <ul class=\"details cols-3\">
                                  <li>
                                    <i class=\"fa fa-map-marker\"></i>
                                    <span>".$row["location"]."</span>
                                  </li>
              
                                  <li>
                                    <i class=\"fa fa-money\"></i>
                                    <span>".$row["salaire"]." / year</span>
                                  </li>
              
                                  <li>
                                    <i class=\"fa fa-certificate\"></i>
                                    <span>".$row["experience"]."/ years of experience</span>
                                  </li>
                                </ul>
                              </footer>
                            </a>
                          </div>";
                        }
                    }else{
                        echo "There are no results matching your search!";
                    }
                }

               
            ?>


          </div>



        </div>
      </section>
    </main>
    <!-- END Main container -->


<?php require 'includes/footer.html' ?>

    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>

  </body>
</html>
