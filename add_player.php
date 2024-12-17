<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $photo = $_POST['photo'];
    $position = $_POST['position'];
    $rating = $_POST['rating'];
    $pace = $_POST['pace'];
    $shooting = $_POST['shooting'];
    $passing = $_POST['passing'];
    $dribbling = $_POST['dribbling'];
    $defending = $_POST['defending'];
    $physical = $_POST['physical'];
    $teamName = $_POST['teamName'];
    $nationalityName = $_POST['nationalityName'];

    // Resolve teamName to teamID
    $teamCheck = $conn->prepare("SELECT teamID FROM teams WHERE name = ?");
    $teamCheck->bind_param("s", $teamName);
    $teamCheck->execute();
    $teamCheck->store_result();
    if ($teamCheck->num_rows == 0) {
        die("Error: Team Name does not exist.");
    }
    $teamCheck->bind_result($teamID);
    $teamCheck->fetch();
    $teamCheck->close();

    // Resolve nationalityName to nationalityID
    $nationalityCheck = $conn->prepare("SELECT nationalityID FROM nationalities WHERE name = ?");
    $nationalityCheck->bind_param("s", $nationalityName);
    $nationalityCheck->execute();
    $nationalityCheck->store_result();
    if ($nationalityCheck->num_rows == 0) {
        die("Error: Nationality Name does not exist.");
    }
    $nationalityCheck->bind_result($nationalityID);
    $nationalityCheck->fetch();
    $nationalityCheck->close();

    $stmt = $conn->prepare("INSERT INTO players (name, photo, position, rating, pace, shooting, passing, dribbling, defending, physical, teamID, nationalityID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiiiiiiii", $name, $photo, $position, $rating, $pace, $shooting, $passing, $dribbling, $defending, $physical, $teamID, $nationalityID);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
}
?>
