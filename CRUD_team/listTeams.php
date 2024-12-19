<?php
include './connect.php';

function listTeams()
{
    global $conn;
    $query = "
    SELECT logo , name , teamID
    FROM teams;
    ";
    $result = $conn->query($query);
    $teams = [];
    while ($row = $result->fetch_assoc()) {
        $teams[] = $row;
    }
    return $teams;
}

$teams = listTeams();





