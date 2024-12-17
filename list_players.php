<?php
include 'connect.php';

function listPlayers() {
    global $conn;
    $query = "
        SELECT
            p.playerID,
            p.name,
            p.photo,
            p.position,
            p.rating,
            p.pace,
            p.shooting,
            p.passing,
            p.dribbling,
            p.defending,
            p.physical,
            t.name AS teamName,
            n.name AS nationalityName
        FROM
            players p
        JOIN
            teams t ON p.teamID = t.teamID
        JOIN
            nationalities n ON p.nationalityID = n.nationalityID
    ";
    $result = $conn->query($query);
    $players = [];
    while ($row = $result->fetch_assoc()) {
        $players[] = $row;
    }
    return $players;
}

$players = listPlayers();
?>
