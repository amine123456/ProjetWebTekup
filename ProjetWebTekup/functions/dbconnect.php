<?php

$sername="localhost";
$user="root";
$pass="";
$dbname="joblist";

$conn=mysqli_connect($sername,$user,$pass,$dbname);

if(!$conn){
    die("Connection failed : ".mysqli_connect_error());
}