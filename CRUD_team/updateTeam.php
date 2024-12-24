<?php
include '../connect.php';

if (isset($_POST['teamID'])) {
    $teamID = $_POST['teamID'];
    $name = $_POST['name'];
    $logo = $_POST['logo'];

    $stmt = $conn->prepare("UPDATE teams SET name = ?, logo = ? WHERE teamID = ?");
    $stmt->bind_param("ssi", $name, $logo, $teamID);
    $stmt->execute();
    $stmt->close();

    header("Location: ../teamTable.php");
    exit();
}

