<?php

require 'dbconnect.php';

$email = $_POST['mail'];
$password = $_POST['password'];

$link = mysqli_connect("localhost", "root", "", "joblist");
mysqli_set_charset($link, 'utf8');



$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);


$pwdcheck=password_verify($password,$row['password']);
if ($pwdcheck==true) {
	//Login Successful Code
    session_start();
    $_SESSION['mail'] = $email;
    $_SESSION['user']= $row['id'];
    echo "		<script>
    new Noty({
            theme: 'metroui',
            timeout: 1500,
            killer: true,
            type: 'success',
            layout: 'topCenter',
            text: 'Login Successful'
        }).show();
</script>" ;

echo "<script>
window.setTimeout(function(){window.location.href = \"jobslist.php\";}, 2000);
</script>";

/*
    header("Location: ../index.php?login=success");
    exit();*/
    
}


else {

    echo "		<script>
    new Noty({
            theme: 'metroui',
            timeout: 1500,
            killer: true,
            type: 'error',
            layout: 'topCenter',
            text: 'Login/Password incorrect'
        }).show();
</script>" ;

/*
    header("Location: ../index.php?login=error");
    exit();*/
		}
?>
