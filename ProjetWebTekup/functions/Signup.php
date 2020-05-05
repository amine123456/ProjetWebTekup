<?php


    require 'dbconnect.php';

    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $naissance=$_POST['naissance'];
    $mail=$_POST['mail'];
    $pwd=$_POST['pwd'];
    $pass_rep=$_POST['pwd-rep'];

    if(empty($nom) || empty($prenom) || empty($naissance) || empty($mail) || empty($pwd) || empty($pass_rep)) {
        header("Location: ../signup.php?error=emptyfields&nom=".$nom."&prenom=".$prenom."&naissance=".$naissance."&mail=".$mail);
        exit();
    } elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidemail&naissance=".$naissance."&nom=".$nom."&prenom=".$prenom);
        exit();
    } elseif((!preg_match("/^[a-zA-Z]*$/",$nom)) || (!preg_match("/^[a-zA-Z]*$/",$prenom))){
        header("Location: ../signup.php?error=nomprenominvalide&naissance=".$naissance."&mail=".$mail);
        exit();
    } elseif($pwd !== $pass_rep){
        header("Location: ../signup.php?error=passwordcheck&nom=".$nom."&prenom=".$prenom."&naissance=".$naissance."&mail=".$mail);
        exit();
    }
    else{
        $sql="SELECT email FROM users WHERE email=?";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s",$mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultnumber=mysqli_stmt_num_rows($stmt);
            if($resultnumber > 0){
                header("Location: ../signup.php?error=emailtaken&nom=".$nom."&prenom=".$prenom."&naissance=".$naissance);
                exit();
            }else {
                $sql="INSERT INTO users(Nom,Prenom,naissance,email,password) VALUES (?,?,?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedpass= password_hash($pwd,PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt,"sssss",$nom,$prenom,$naissance,$mail,$hashedpass);
                    mysqli_stmt_execute($stmt);
                    

                    header("Location: ../signup.php?signup=success");
                    exit();

                }
            }
        }
    }

