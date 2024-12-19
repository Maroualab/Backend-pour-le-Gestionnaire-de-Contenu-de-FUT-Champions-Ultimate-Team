<?php
include 'connect.php';

    $query = "
    SELECT teamID , name teamName
    FROM teams;
    ";
    $result = $conn->query($query);
    $teams = [];
    while ($row = $result->fetch_assoc()) {
        $teams[] = $row;
    }

// $nationalities = select();

