<?php

session_start();
    require 'dbconnect.php';

    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $naissance=$_POST['naissance'];
    $mail=$_POST['mail'];
    $pwd=$_POST['pwd'];
    $pass_rep=$_POST['pwd-rep'];
    $userid=$_SESSION['user'];

    if(empty($nom) || empty($prenom) || empty($naissance) || empty($mail)) {
        header("Location: ../editprofile.php?error=emptyfields&nom=".$nom."&prenom=".$prenom."&naissance=".$naissance."&mail=".$mail);
        exit();
    } elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        header("Location: ../editprofile.php?error=invalidemail&naissance=".$naissance."&nom=".$nom."&prenom=".$prenom);
        exit();
    } elseif((!preg_match("/^[a-zA-Z]*$/",$nom)) || (!preg_match("/^[a-zA-Z]*$/",$prenom))){
        header("Location: ../editprofile.php?error=nomprenominvalide&naissance=".$naissance."&mail=".$mail);
        exit();
    } elseif($pwd !== $pass_rep){
        header("Location: ../editprofile.php?error=passwordcheck&nom=".$nom."&prenom=".$prenom."&naissance=".$naissance."&mail=".$mail);
        exit();
    }

        $sql="SELECT email FROM users WHERE email=?";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../editprofile.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s",$mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultnumber=mysqli_stmt_num_rows($stmt);
            if($resultnumber > 1){
                header("Location: ../editprofile.php?error=emailtaken&nom=".$nom."&prenom=".$prenom."&naissance=".$naissance);
                exit();
            }else {
                $hashedpass= password_hash($pwd,PASSWORD_DEFAULT);
                $sql = "UPDATE users SET Nom='$nom', Prenom='$prenom', email='$mail', naissance='$naissance', password='$hashedpass' WHERE id=$userid";
                if ($conn->query($sql) === TRUE) {
                    header("Location: ../editprofile.php?upload=success");
                    exit();
                }else {
                
                
                header("Location: ../editprofile.php?upload=fail");
                exit();
                
                }
            }
        }
    

