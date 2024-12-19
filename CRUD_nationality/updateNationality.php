<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nationalityID = $_POST['nationalityID'];
    $name = $_POST['name'];
    $flag = $_POST['flag'];

    $stmt = $conn->prepare("UPDATE nationalities SET name = ?, flag = ? WHERE nationalityID = ?");
    $stmt->bind_param("ssi", $name, $flag, $nationalityID);
    $stmt->execute();
    $stmt->close();

    header("Location: ../nationalityTable.php");
    exit();
}

