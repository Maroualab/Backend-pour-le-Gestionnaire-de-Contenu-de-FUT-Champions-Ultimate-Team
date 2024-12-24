<?php
include '../connect.php';

if (isset($_POST['playerID'])) {
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

    $stmt = $conn->prepare("INSERT INTO players (name, photo, position, rating, pace, shooting, passing, dribbling, defending, physical, teamID, nationalityID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiiiiiiii", $name, $photo, $position, $rating, $pace, $shooting, $passing, $dribbling, $defending, $physical, $teamID, $nationalityID);
    $stmt->execute();
    $stmt->close();

    header("Location: ../dashboard.php");
}

