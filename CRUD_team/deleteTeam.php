<?php
include '../connect.php';

if (isset($_GET['teamID'])) {
    $teamId = $_GET['teamID'];

    $sql = "DELETE FROM teams WHERE teamID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $teamId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Club deleted successfully!";
    } else {
        echo "Failed to delete club. Please try again.";
    }

    $stmt->close();
    header("Location: ../teamTable.php"); 
    exit();
} else {
    echo "Team ID not provided.";
}
