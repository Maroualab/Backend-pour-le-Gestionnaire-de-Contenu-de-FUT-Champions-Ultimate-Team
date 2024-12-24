<?php
include '../connect.php';

if (isset($_POST['nationalityID'])) {
    $name = $_POST['name'];
    $flag = $_POST['flag'];


    $stmt = $conn->prepare("INSERT INTO nationalities (name, flag) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $flag);
    $stmt->execute();
    $stmt->close();

    header("Location: ../nationalityTable.php");
}

