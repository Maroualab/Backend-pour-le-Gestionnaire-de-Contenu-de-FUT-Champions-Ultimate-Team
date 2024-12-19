<?php
include './connect.php';

function listNationalities()
{
    global $conn;
    $query = "
    SELECT flag , name , nationalityID
    FROM nationalities;
    ";
    $result = $conn->query($query);
    $nationalities = [];
    while ($row = $result->fetch_assoc()) {
        $nationalities[] = $row;
    }
    return $nationalities;
}

$nationalities = listNationalities();





