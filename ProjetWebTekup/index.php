

<style>
body{
	background-color:#25373D !important;

}

#wrapy{
	position:fixed;
	z-index:-1;
	top:0;
	left:0;
	background-color:black

}
#wrapy img.bgfade{
	position:absolute;
	top:0;
	display:none;
	width:100%;
	height:100%;
	z-index:-1
}

.box {

	height: 100%;

}


.loginBtn:focus {
  outline: none;
}
.loginBtn:active {
  box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
}

.loginBtn a:hover {
	color : white;
}
.loginBtn a {
	color : white;
}


</style>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Job search Website">
    <meta name="keywords" content="">

    <title>JobFound</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
	<link href="assets/css/noty.css" rel="stylesheet">

	<!--JQUERT -->
	<script src="assets/js/jquery1_8_2.js"></script>

	<script>
	//change image every 3 seconds
	$(window).load(function(){

		$('img.bgfade').hide();
		var dg_H = $(window).height();
		var dg_W = $(window).width();
		$('#wrapy').css({'height':"1200px",'width':"1900px"});

		function anim() {
			$("#wrapy img.bgfade").first().appendTo('#wrapy').fadeOut(1500);
			$("#wrapy img").first().fadeIn(1500);
			setTimeout(anim, 3000);
		}
		anim();
	})
	$(window).resize(function(){window.location.href=window.location.href})
	</script>

   <!--<link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'> -->

	<!--fonts-->
	 <link href="assets/fonts/Oswald.css" rel="stylesheet">
	<link href="assets/fonts/OpenSans.css" rel="stylesheet">


    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">



  <div id="wrapy">
<img class="bgfade" src="assets/img/1.jpg">
<img class="bgfade" src="assets/img/wallhaven-eovv3r.jpg">
<img class="bgfade" src="assets/img/wallhaven-q66kx5.jpg">

</div>







    <!-- Navigation bar -->
    <nav class="navbar">
      <div class="container">

        <!-- Logo -->
        <div class="pull-left">
          <a class="navbar-toggle" href="#" data-toggle="offcanvas"></a>

          <div class="logo-wrapper">
            <a class="logo" href="index.html"><img src="assets/img/logomini.png" alt="logo"></a>
            <a class="logo-alt" href="index.html"><img src="assets/img/logomini.png" alt="logo-alt"></a>
          </div>

        </div>
        <!-- END Logo -->

        <!-- User account -->
        <div class="pull-right user-login">
          <a class="btn btn-sm btn-primary" href="signup.php">Register Now</a>
        </div>
        <!-- END User account -->



      </div>
    </nav>
    <!-- END Navigation bar -->


    <!-- Site headerrrrrrrrrrrrrrrrrrrr -->
    <header class="site-header size-lg text-center box" >
      <div class="container">
        <div class="col-xs-12">

          <img src="assets/img/found3.png" class="image-responsive" width="408px">

          <form action="functions/login.php" method="POST" id="myForm" class="header-job-search" autocomplete="off">
            <div class="input-keyword">
              <input type="text" class="form-control" placeholder="Your Email Adress" name="mail" id="username" required>
            </div>

            <div class="input-location">
              <input type="password" class="form-control" placeholder="Your Password" name="password" id="password" required>
            </div>

            <div class="btn-search">
              <button class="btn btn-primary" type="submit" id="submit" name="login">Login</button>
            </div>

          </form>

		  <!--result login-->
		  <div id="ack"></div>

        </div>

      </div>
    </header>
    <!-- END Site header -->



    <!-- Scripts -->
		<script src="assets/js/noty.js"></script>






	<script src="assets/js/myscript.js"></script>

  </body>
</html>
