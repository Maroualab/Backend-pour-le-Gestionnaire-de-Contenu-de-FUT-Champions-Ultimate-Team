<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['teamID'])) {
    $teamID = $_GET['teamID'];
    $query = "SELECT logo, name, teamID FROM teams WHERE teamID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowTeam = $result->fetch_assoc();
    echo json_encode($rowTeam);
    $stmt->close();
}
?>
