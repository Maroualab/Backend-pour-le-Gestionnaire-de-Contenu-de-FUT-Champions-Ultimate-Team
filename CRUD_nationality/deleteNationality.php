<?php
include '../connect.php';

if (isset($_GET['nationalityID'])) {
    $nationalityId = $_GET['nationalityID'];

    $sql = "DELETE FROM nationalities WHERE nationalityID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $nationalityId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Nationality deleted successfully!";
    } else {
        echo "Failed to delete nationality. Please try again.";
    }

    $stmt->close();
    header("Location: ../nationalityTable.php"); 
    exit();
} else {
    echo "Nationality ID not provided.";
}
