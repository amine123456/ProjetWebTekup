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
$jobid      =$_GET['jobid'];


$uploadOk = 1;

if(empty($_FILES['fileToUpload']['name'])){
    $servername = "localhost";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=joblist", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


    $query = "SELECT * FROM job WHERE id = :jobid LIMIT 1";
$statement = $pdo->prepare($query);
$params = array(
    'jobid' => $_GET["jobid"]
);
$statement->execute($params);
$row = $statement->fetch();

$rand_filename=$row['image'];

}    //image upload
else{
$target_dir = "../uploads/job_images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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



}
if ($uploadOk == 0) {

	echo "<script>alert('error');window.location=\"../addjob.php\"</script>";

} else {


    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], '../uploads/job_images/' . $rand_filename);

    $sql = "UPDATE job SET titre='$titre', description='$description', url='$website', location='$location', workhours='$workhours', salaire='$salaire', Company='$Company', experience='$experience', contract='$contact', image='$rand_filename', contacte='$contact', publishdate=current_timestamp, Domaine='$domaine' WHERE id=$jobid";

if ($conn->query($sql) === TRUE) {
    header("Location: ../myjobs.php?upload=success");
    exit();
}else {


header("Location: ../addjob.php?upload=fail");
exit();

}
$conn->close();
 }
