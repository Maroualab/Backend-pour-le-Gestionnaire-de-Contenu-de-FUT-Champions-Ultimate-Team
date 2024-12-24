<?php
$dbName = "fut_champions";
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";

$conn =new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

