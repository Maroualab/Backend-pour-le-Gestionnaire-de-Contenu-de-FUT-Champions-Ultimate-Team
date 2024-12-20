<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nationalityID'])) {
    $nationalityID = $_GET['nationalityID'];
    $query = "SELECT flag, name, nationalityID FROM nationalities WHERE nationalityID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $nationalityID);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowNationality = $result->fetch_assoc();
    echo json_encode($rowNationality);
    $stmt->close();
}

