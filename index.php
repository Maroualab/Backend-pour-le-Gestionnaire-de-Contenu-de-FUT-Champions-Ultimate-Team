<?php
include 'connect.php';

$sql = "SELECT p.photo, p.playerID, p.name AS playerName, n.name AS nationality, p.position, p.rating, p.pace, p.shooting, p.passing, p.dribbling, p.defending, p.physical
FROM players p
INNER JOIN nationalities n ON p.nationalityID = n.nationalityID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Joueurs</title>
</head>
<body>
    <nav>
        <img src="img/people.png" alt="logo">
        <button><a href="addPlayer.php">Add Player</a></button>
    </nav>
    <h1>Liste des Joueurs</h1>
    <table>
        <thead>
            <tr>
                <th>Img</th>
                <th>Name</th>
                <th>Position</th>
                <th>Nationality</th>
                <th>Rating</th>
                <th>Pace</th>
                <th>Shooting</th>
                <th>Passing</th>
                <th>Dribbling</th>
                <th>Defending</th>
                <th>Physical</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='$row[photo]' height=20 width=20/></td>";
                    echo "<td>" . $row["playerName"] . "</td>";
                    echo "<td>" . $row["position"] . "</td>";
                    echo "<td>" . $row["nationality"] . "</td>";
                    echo "<td>" . $row["rating"] . "</td>";
                    echo "<td>" . $row["pace"] . "</td>";
                    echo "<td>" . $row["shooting"] . "</td>";
                    echo "<td>" . $row["passing"] . "</td>";
                    echo "<td>" . $row["dribbling"] . "</td>";
                    echo "<td>" . $row["defending"] . "</td>";
                    echo "<td>" . $row["physical"] . "</td>";
                    echo "<td><a href='updatePlayer.php?id=" . $row["playerID"] . "'>Modifier</a> | <a href='deletePlayer.php?id=" . $row["playerID"] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun joueur trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

