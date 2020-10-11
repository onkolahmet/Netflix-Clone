<?php
ob_start(); // Turns on output buffering
session_start(); // if the user logged in or not

date_default_timezone_set("Europe/Istanbul");
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$servername = $url["host"];

$username = $url["user"];

$password = $url["pass"];

$db = substr($url["path"], 1);


try {
   $con = new PDO("mysql:dbname=$db;host=$servername", $username, $password);
//     $con = new PDO("mysql:dbname=ahmetflix;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch(PDOException $e){
    exit("Connection failed: " . $e->getMessage());
}
?>