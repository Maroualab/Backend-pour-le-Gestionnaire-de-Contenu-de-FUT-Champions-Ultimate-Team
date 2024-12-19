<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $logo = $_POST['logo'];


    $stmt = $conn->prepare("INSERT INTO teams (name, logo) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $logo);
    $stmt->execute();
    $stmt->close();

    header("Location: ../teamTable.php");
}

