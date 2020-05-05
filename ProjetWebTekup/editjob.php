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

    <title>Edit Job</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/vendors/summernote/summernote.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/noty.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">

    <!-- Navigation bar -->
    <?php include "includes/navbar.html" 
    
    ?>
    <?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=joblist", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


    $query = "SELECT * FROM job WHERE id = :jobid LIMIT 1";
$statement = $conn->prepare($query);
$params = array(
    'jobid' => $_GET["jobid"]
);
$statement->execute($params);
$row = $statement->fetch();

$jobid=$_GET['jobid'];

?>
    <!-- END Navigation bar -->

    <form action="functions/editjob.php?jobid=<?php echo $jobid?>" method="post" enctype="multipart/form-data">
		  <!--result login-->
		  <div id="ack"></div>
    

      <!-- Page header -->
      <header class="page-header">
        <div class="container page-name">
          <h1 class="text-center">Edit a job</h1>
          <p class="lead text-center">Create your resume and put it online.</p>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <div class="form-group">
                <input type="file" name="fileToUpload" class="dropify" id="fileToUpload" data-default-file="uploads/job_images/<?php  echo $row['image']?>" >
                <span class="help-block">Please choose a 4:6 profile picture.</span>
              </div>
            </div>

            <div class="col-xs-12 col-sm-8">
              <div class="form-group">
                <input type="text" name="titre" class="form-control input-lg" placeholder="Job Title" <?php echo "value=\"".$row['titre']."\""; ?> required>
              </div>
              
              <div class="form-group">
                <input type="text" name="Company" class="form-control" placeholder="Company Name"   <?php echo "value=\"".$row['Company']."\""; ?> required>
              </div>

              <div class="form-group">
                <input type="text" name="contact" class="form-control" placeholder="Contact"    <?php echo "value=\"".$row['contacte']."\""; ?> required>
              </div>

              <div class="form-group">
                <input type="text" name="website" class="form-control" placeholder="Website"    <?php echo "value=\"".$row['url']."\""; ?>  required>
              </div>

              <div class="form-group">
                <textarea class="form-control" name="description" rows="3" placeholder="Short description"  required><?php echo $row['description']; ?></textarea>
              </div>

              <hr class="hr-lg">    

              <div class="row">
                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                    <input type="text" name="experience" class="form-control" placeholder="experience" <?php echo "value=\"".$row['experience']."\""; ?> required>
                  </div>
                </div>  
                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" name="location" class="form-control" placeholder="Location, e.g. Melon Park, CA" <?php echo "value=\"".$row['location']."\""; ?> required>
                  </div>
                </div>



                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" name="salaire" class="form-control" placeholder="Salary, e.g. 85" <?php echo "value=\"".$row['salaire']."\""; ?> required>
                    <span class="input-group-addon" >Per month</span>
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6"> 
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    <input type="text" name="workhours" class="form-control" placeholder="Working hours" <?php echo "value=\"".$row['workhours']."\""; ?> required>
                    <span class="input-group-addon">hours / week</span>
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
              <select name="Contrat" class="form-control selectpicker">
                <option value="CDI">CDI</option>
                <option value="Full-Time">Full-Time</option>
                <option value="Stage/Aprentissage">Stage/Aprentissage</option>
                <option value="CDD">CDD</option>
                <option value="Indépendant/Freelance">Indépendant/Freelance</option>

              </select>
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
              <select name="Domaine" class="form-control selectpicker">
                <option value="Domaine Informatique">Domaine Informatique</option>
                <option value="Domaine Fabrication">Domaine Fabrication</option>
                <option value="Domaine Design">Domaine Design</option>
                <option value="Domaine Marketing">Domaine Marketing</option>
                <option value="autre">Autre</option>
              </select>
                  </div>
                </div>

              </div>


            </div>
          </div>

          <div class="button-group">
            <div class="action-buttons">

              <div class="upload-button">
              <button class="btn btn-success" type="submit" id="submit" name="Submit">Submit</button>
              </div>



            </div>
          </div>
        </div>
      </header>
      <!-- END Page header -->


      <!-- Main container -->
      <main>








      </main>
      <!-- END Main container -->

    </form>

    <?php include 'includes/footer.html' ?>


    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/vendors/summernote/summernote.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- Scripts -->
		<script src="assets/js/noty.js"></script>

  </body>
</html>
