
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">

    <title>Register</title>

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


      <!-- Navigation bar -->
      <nav class="navbar">
      <div class="container">

        <!-- Logo -->
        <div class="pull-left">
          <a class="navbar-toggle" href="index.php" data-toggle="offcanvas"><i class="ti-menu"></i></a>

          <div class="logo-wrapper">
            <a class="logo" href="index.php"><img src="assets/img/logomini.png" alt="logo"></a>
            <a class="logo-alt" href="index.php"><img src="assets/img/logomini.png" alt="logo-alt"></a>
          </div>

        </div>
        <!-- END Logo -->

        <!-- User account -->
        <div class="pull-right user-login">
          <a class="btn btn-sm btn-primary" href="index.php"><i class="kk kk-Key"></i>&nbsp;Login</a>
        </div>
        <!-- END User account -->



      </div>
    </nav>


    <!-- Site header -->
    <header class="site-header size-lg text-center" style="background-image: url(assets/img/graphs.jpg)">
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

    if(isset($_GET['signup'])){
      if($_GET['signup'] == "success"){
        echo "<div class=\"alert alert-success\" role=\"alert\">
        <p>Votre compte a été crée avec succées</p>
      </div>";
      }
    }
  ?>
    <h1>Create an account</h1>

    <form  action="functions/Signup.php" method="post">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-user"></i></span>
          <input type="text" class="form-control" name="nom" <?php if(isset($_GET['nom'])){echo "value=\"".$_GET['nom']."\"";}else echo "placeholder=\"ecrire votre nom\""  ?>>

          <span class="input-group-addon"><i class="ti-user"></i></span>
          <input type="text" class="form-control" name="prenom"<?php if(isset($_GET['nom'])){echo "value=\"".$_GET['prenom']."\"";}else echo "placeholder=\"ecrire votre prenom\""  ?>>

        </div>
      </div>
      
      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon"><i class="ti-time"></i></span>
          <input type="date" class="form-control" name="naissance" <?php if(isset($_GET['nom'])){echo "value=\"".$_GET['naissance']."\"";}?>>

          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input type="text" class="form-control" name="mail" <?php if(isset($_GET['mail'])){echo "value=\"".$_GET['mail']."\"";}else echo "placeholder=\"ecrire votre email\""  ?>>
        </div>
      </div>
      
      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-unlock"></i></span>
          <input type="password" class="form-control" name="pwd" placeholder="votre mot de passe">

          <span class="input-group-addon"><i class="ti-unlock"></i></span>
          <input type="password" class="form-control" name="pwd-rep" placeholder="réecrire le mot de passe">
        </div>
      </div>

      <button class="btn btn-primary btn-block" type="submit">Sign up</button>



    </form>
    <div id="ack"></div>

  </div>

  <div class="login-links">
    <p class="text-center">Already have an account? <a class="txt-brand" href="index.php">Login</a></p>
  </div>

</main>



    <!-- Scripts -->
		<script src="assets/js/noty.js"></script>

    <script src="assets/js/myscript.js"></script>


</body>
</html>
