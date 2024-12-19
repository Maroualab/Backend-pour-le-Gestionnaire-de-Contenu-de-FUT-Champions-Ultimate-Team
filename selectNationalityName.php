<?php
include 'connect.php';

    $query = "
    SELECT nationalityID , name nationalityName
    FROM nationalities;
    ";
    $result = $conn->query($query);
    $nationalities = [];
    while ($row = $result->fetch_assoc()) {
        $nationalities[] = $row;
    }

// $nationalities = select();

