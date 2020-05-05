<?php
session_start();
require_once('dbconnect.php');

$auteur     =$_SESSION['user'];
$titre      =$_POST['titre'];
$Company    =$_POST['Company'];
$contact    =$_POST['contact'];
$website    =$_POST['website'];
$description=$_POST['description'];
$location   =$_POST['location'];
$experience =$_POST['experience'];
$salaire    =$_POST['salaire'];
$workhours  =$_POST['workhours'];
$contrat    =$_POST['Contrat'];
$domaine    =$_POST['Domaine'];


//image upload

$target_dir = "../uploads/job_images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


$rand_char = uniqid(rand()) ; // random name
$target_rand_name = $target_dir . $rand_char . ".$imageFileType";
$rand_filename = $rand_char . ".$imageFileType" ;

$test=basename($_FILES["fileToUpload"]["name"]);

// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<script>alert(\"File is not an image $test .\");</script>";
        $uploadOk = 0;
    }




if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script>alert(\Sorry, only JPG, JPEG, PNG & GIF files are allowed.\");</script>";
    $uploadOk = 0;

}


//si upload est OK alors inserer dans la base

if ($uploadOk == 0) {

	echo "<script>alert('error');window.location=\"../addjob.php\"</script>";

} else {


    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], '../uploads/job_images/' . $rand_filename);

    $sql = "INSERT INTO job (titre, description, url, location, workhours, salaire, Company, experience,contract,image,contacte,Domaine,auteur)
    VALUES ('$titre','$description','$website','$location','$workhours','$salaire','$Company','$experience','$contrat','$rand_filename','$contact','$domaine','$auteur')";

if ($conn->query($sql) === TRUE) {
    
    header("Location: ../jobslist.php?upload=success");
    exit();
}else {


header("Location: ../addjob.php?upload=fail");
exit();

}
$conn->close();


}
    
