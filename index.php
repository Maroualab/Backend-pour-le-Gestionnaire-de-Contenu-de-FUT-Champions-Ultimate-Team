<?php
include 'connect.php'; 

$sql = "SELECT * FROM players";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Joueurs</title>
</head>
<body>
    <h1>Liste des Joueurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Poste</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["playerID"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["position"] . "</td>";
                echo "<td>" . $row["nationalityID"] . "</td>";
                echo "<td><a href='modifier_joueur.php?id=" . $row["playerID"] . "'>Modifier</a> | <a href='supprimer_joueur.php?id=" . $row["playerID"] . "'>Supprimer</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Aucun joueur trouvé</td></tr>";
        }
        ?>
        </tbody>
    </table>
    <a href="ajouter_joueur.php">Ajouter un joueur</a>
</body>
</html>