<?php
include("./connect.php");
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $sql = "SELECT
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
          WHERE playerID=$id;";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $editplayer[] = $row;
    }
    header("location:./");
    echo print_r($editplayer);
}

