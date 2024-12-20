<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $photo = $_POST['photo'];


    $stmt = $conn->prepare("INSERT INTO teams (name, logo) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $photo);
    $stmt->execute();
    $stmt->close();

    header("Location: ../teamTable.php");
}

