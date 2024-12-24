<?php
include '../connect.php';

if (isset($_GET['playerID'])) {
    
    $playerId = $_GET['playerID'];

    $sql = "DELETE FROM players WHERE playerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $playerId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Player deleted successfully!";
    } else {
        echo "Failed to delete player. Please try again.";
    }

    $stmt->close();
    header("Location: ../dashboard.php"); 
    exit();
} else {
    echo "Player ID not provided.";
}
