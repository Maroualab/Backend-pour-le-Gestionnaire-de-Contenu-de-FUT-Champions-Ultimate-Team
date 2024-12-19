<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $playerID = $_POST['playerID'];
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
    $teamID = $_POST['teamID'];
    $nationalityID = $_POST['nationalityID'];

    $teamCheck = $conn->prepare("SELECT teamID FROM teams WHERE teamID = ?");
    $teamCheck->bind_param("i", $teamID);
    $teamCheck->execute();
    $teamCheck->store_result();
    if ($teamCheck->num_rows == 0) {
        die("Error: Team ID does not exist.");
    }
    $teamCheck->close();

    $nationalityCheck = $conn->prepare("SELECT nationalityID FROM nationalities WHERE nationalityID = ?");
    $nationalityCheck->bind_param("i", $nationalityID);
    $nationalityCheck->execute();
    $nationalityCheck->store_result();
    if ($nationalityCheck->num_rows == 0) {
        die("Error: Nationality ID does not exist.");
    }
    $nationalityCheck->close();

    $stmt = $conn->prepare("UPDATE players SET name=?, photo=?, position=?, rating=?, pace=?, shooting=?, passing=?, dribbling=?, defending=?, physical=?, teamID=?, nationalityID=? WHERE playerID=?");
    $stmt->bind_param("sssiiiiiiiiii", $name, $photo, $position, $rating, $pace, $shooting, $passing, $dribbling, $defending, $physical, $teamID, $nationalityID, $playerID);
    $stmt->execute();
    $stmt->close();

    header("Location: ../dashboard.php");
    exit();
}