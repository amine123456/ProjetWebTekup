<?php

session_start();

//Suppimmer un job 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "joblist";
$jobid  = $_GET['jobid'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = "DELETE FROM job WHERE id=$jobid";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    header("Location: ../myjobdetail.php?delete=success");

$conn = null;
?>