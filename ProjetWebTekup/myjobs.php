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

    <title>My Jobs</title>

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
        <h1 class="text-center">My Jobs</h1>
        <p class="lead text-center">Here you can find all the jobs that you posted</p>

      </div>

      <div class="container">
      <form action="search.php" method="post">

<div class="row">
  <div class="form-group col-xs-12 col-sm-4">
    <input type="text" name="searcht" class="form-control" placeholder="Titre">
  </div>

  <div class="form-group col-xs-12 col-sm-4">
    <select name="domaine" class="form-control selectpicker">
      <option>Domaine Informatique</option>
      <option>Domaine Design</option>
      <option>Domaine Fabrication</option>
      <option>Domaine Marketing</option>

      <option>Autre</option>
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

           <!-- <div class="col-xs-12">
              <br>
              <h5>We found <strong>357</strong> matches, you're watching <i>10</i> to <i>20</i></h5>
            </div>
    -->


            <?php 

                require 'functions/variousfunc.php';
                require 'functions/dbconnect.php';     
                

$sername="localhost";
$user="root";
$pass="";
$dbname="joblist";

try {
    $dbh = new PDO("mysql:host=$sername;dbname=$dbname", $user, $pass);
    // set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }



                try {

                    // Find out how many items are in the table
                    $total = $dbh->query('
                        SELECT
                            COUNT(*)
                        FROM
                            job
                    ')->fetchColumn();
                
                    // How many items to list per page
                    $limit = 10;
                
                    // How many pages will there be
                    $pages = ceil($total / $limit);
                
                    // What page are we currently on?
                    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                        'options' => array(
                            'default'   => 1,
                            'min_range' => 1,
                        ),
                    )));
                
                    // Calculate the offset for the query
                    $offset = ($page - 1)  * $limit;
                
                    // Some information to display to the user
                    $start = $offset + 1;
                    $end = min(($offset + $limit), $total);
                
                $id=$_SESSION['user'];
                    // Prepare the paged query
                    $stmt = $dbh->prepare("
                        SELECT
                            *
                        FROM
                            job
                            WHERE
                            auteur=:id

                        ORDER BY
                            publishdate
                        LIMIT
                            :limit
                        OFFSET
                            :offset

                    ");
                
                    // Bind the query params
                    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    $stmt->execute();
                
                    // Do we have any results?
                    if ($stmt->rowCount() > 0) {
                        // Define how we want to fetch the results
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $iterator = new IteratorIterator($stmt);
                
                        // Display the results
                        foreach ($iterator as $row) {
                          echo "<div class=\"col-xs-12\">
                          <a class=\"item-block\" href=\"myjobdetail.php?jobid=".$row['id']."\">
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
                        </div>";                        }
                
                    } else {
                        echo '<p>No results could be displayed.</p>';
                    }
                
                } catch (Exception $e) {
                    echo '<p>', $e->getMessage(), '</p>';
                }

                   // The "back" link
                   $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
                
                   // The "forward" link
                   $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
               
                   // Display the paging information
                    echo '<nav class="text-center"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></nav>';



            ?>



          </div>



        </div>
      </section>
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
