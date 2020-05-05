<?php session_start();
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

    <title>Edit Profile</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/noty.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>


	<!--JQUERT -->
	<script src="assets/js/jquery1_8_2.js"></script>


    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">



<?php require 'includes/navbar.html' ?>

    <!-- Site header -->
    <header class="site-header size-lg text-center" style="background-image: url(assets/img/wallhaven-r7z7z1.jpg)">
      <div class="container">
        <div class="col-xs-12">
<main>

  <div class="login-block">

  <?php
    if(isset($_GET['error'])){
      if($_GET['error'] == "emptyfields"){
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        <p> Veuillez remplir tout les champs</p>
      </div>";
      }elseif($_GET['error'] == "invalidemail"){
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        <p> L'adresse mail est invalide</p>
      </div>";
      }elseif($_GET['error'] == "nomprenominvalide"){
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        <p> Le nom ou le prenom choisit est invalide</p>
      </div>";
      }elseif($_GET['error'] == "passwordcheck"){
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        <p> Veuillez réecrire le mot de passe correctement</p>
      </div>";
      }
    }

    if(isset($_GET['upload'])){
      if($_GET['upload'] == "success"){
        echo "<div class=\"alert alert-success\" role=\"alert\">
        <p>Votre compte a été modifié avec succées</p>
      </div>";
      }
    }
  ?>
    <h1>Edit my account</h1>
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


    $query = "SELECT * FROM users WHERE id = :userid LIMIT 1";
$statement = $conn->prepare($query);
$params = array(
    'userid' => $_SESSION['user']
);
$statement->execute($params);
$row = $statement->fetch();


?>

    <form  action="functions/editprofile.php" method="post">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-user"></i></span>
          <input type="text" class="form-control" name="nom" value="<?php echo $row['Nom']?>" placeholder="<?php if(isset($_GET['nom'])){echo $_GET['nom'];}else echo 'ecrire votre nom' ?>" required>

          <span class="input-group-addon"><i class="ti-user"></i></span>
          <input type="text" class="form-control" name="prenom" value="<?php echo $row['Prenom']?>" placeholder="<?php if(isset($_GET['prenom'])){echo $_GET['prenom'];}else echo 'ecrire votre prenom' ?>" required>

        </div>
      </div>
      
      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon"><i class="ti-time"></i></span>
          <input type="date" class="form-control" name="naissance" value="<?php echo $row['naissance']?>" placeholder="<?php if(isset($_GET['naissance'])){echo $_GET['naissance'];}?>" required>

          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input type="text" class="form-control" name="mail" value="<?php echo $row['email']?>" placeholder="<?php if(isset($_GET['mail'])){echo $_GET['mail'];}else echo 'ecrire votre mail' ?>" required>
        </div>
      </div>
      
      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-unlock"></i></span>
          <input type="password" class="form-control" name="pwd" placeholder="votre mot de passe" required>

          <span class="input-group-addon"><i class="ti-unlock"></i></span>
          <input type="password" class="form-control" name="pwd-rep" placeholder="réecrire le mot de passe" required>
        </div>
      </div>

      <button class="btn btn-primary btn-block" type="submit">Sign up</button>

    </form>
    <div id="ack"></div>

  </div>



</main>



    <!-- Scripts -->
		<script src="assets/js/noty.js"></script>

    <script src="assets/js/myscript.js"></script>


</body>
</html>
