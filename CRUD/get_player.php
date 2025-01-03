<?php
include '../connect.php';

if (isset($_GET['playerID'])) {
    $playerID = $_GET['playerID'];
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
            p.teamID,
            p.nationalityID,
            t.name AS teamName,
            n.name AS nationalityName
        FROM
            players p
        LEFT JOIN
            teams t ON p.teamID = t.teamID
        LEFT JOIN
            nationalities n ON p.nationalityID = n.nationalityID
        WHERE
            p.playerID = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $playerID);
    $stmt->execute();
    $result = $stmt->get_result();
    $player = $result->fetch_assoc();
    echo json_encode($player);
    $stmt->close();
}