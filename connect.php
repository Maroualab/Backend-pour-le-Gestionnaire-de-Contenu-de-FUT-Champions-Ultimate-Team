<?php
$dbName = "fut_champions";
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Something went wrong");
}
?>