<!DOCTYPE html>
<html>
<head>
    <title>Player Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
    </style>
</head>
<body>
    <h1>Player Dashboard</h1>
    <button onclick="openPopup('add')">Add New Player</button>
    <table>
        <tr>
            <th>Name</th>
            <th>Photo</th>
            <th>Position</th>
            <th>Rating</th>
            <th>Pace</th>
            <th>Shooting</th>
            <th>Passing</th>
            <th>Dribbling</th>
            <th>Defending</th>
            <th>Physical</th>
            <th>Team</th>
            <th>Nationality</th>
            <th>Actions</th>
        </tr>
        <?php
        include 'list_players.php';
        foreach ($players as $player) {
            echo "<tr>";
            echo "<td>{$player['name']}</td>";
            echo "<td><img src='{$player['photo']}' width='50'></td>";
            echo "<td>{$player['position']}</td>";
            echo "<td>{$player['rating']}</td>";
            echo "<td>{$player['pace']}</td>";
            echo "<td>{$player['shooting']}</td>";
            echo "<td>{$player['passing']}</td>";
            echo "<td>{$player['dribbling']}</td>";
            echo "<td>{$player['defending']}</td>";
            echo "<td>{$player['physical']}</td>";
            echo "<td>{$player['teamName']}</td>";
            echo "<td>{$player['nationalityName']}</td>";
            echo "<td>
                    <a href='?edit=$player[playerID]'><button onclick='openPopup(\"edit\", {$player['playerID']})'><i class='fas fa-edit'></i></button></a>
                    <button onclick='deletePlayer({$player['playerID']})'><i class='fas fa-trash'></i></button>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <form id="playerForm" method="post">
                <input type="hidden" id="playerID" name="playerID">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="photo">Photo:</label>
                <input type="text" id="photo" name="photo" required><br>
                <label for="position">Position:</label>
                <input type="text" id="position" name="position" required><br>
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating" required><br>
                <label for="pace">Pace:</label>
                <input type="number" id="pace" name="pace" required><br>
                <label for="shooting">Shooting:</label>
                <input type="number" id="shooting" name="shooting" required><br>
                <label for="passing">Passing:</label>
                <input type="number" id="passing" name="passing" required><br>
                <label for="dribbling">Dribbling:</label>
                <input type="number" id="dribbling" name="dribbling" required><br>
                <label for="defending">Defending:</label>
                <input type="number" id="defending" name="defending" required><br>
                <label for="physical">Physical:</label>
                <input type="number" id="physical" name="physical" required><br>
                <label for="teamName">Team Name:</label>
                <input type="text" id="teamName" name="teamName" required><br>
                <label for="nationalityName">Nationality Name:</label>
                <input type="text" id="nationalityName" name="nationalityName" required><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <script>
        function openPopup(action, playerID = null) {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('playerForm').action = action === 'add' ? 'add_player.php' : 'update_player.php';
            document.getElementById('playerID').value = '';
            document.getElementById('name').value = '';
            document.getElementById('photo').value = '';
            document.getElementById('position').value = '';
            document.getElementById('rating').value = '';
            document.getElementById('pace').value = '';
            document.getElementById('shooting').value = '';
            document.getElementById('passing').value = '';
            document.getElementById('dribbling').value = '';
            document.getElementById('defending').value = '';
            document.getElementById('physical').value = '';
            document.getElementById('teamName').value = '';
            document.getElementById('nationalityName').value = '';

            if (action === 'edit') {
                fetch('get_player.php?playerID=' + playerID)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('playerID').value = data.playerID;
                        document.getElementById('name').value = data.name;
                        document.getElementById('photo').value = data.photo;
                        document.getElementById('position').value = data.position;
                        document.getElementById('rating').value = data.rating;
                        document.getElementById('pace').value = data.pace;
                        document.getElementById('shooting').value = data.shooting;
                        document.getElementById('passing').value = data.passing;
                        document.getElementById('dribbling').value = data.dribbling;
                        document.getElementById('defending').value = data.defending;
                        document.getElementById('physical').value = data.physical;
                        document.getElementById('teamName').value = data.teamName;
                        document.getElementById('nationalityName').value = data.nationalityName;
                    });
            }
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function deletePlayer(playerID) {
            if (confirm('Are you sure you want to delete this player?')) {
                window.location.href = 'delete_player.php?playerID=' + playerID;
            }
        }
    </script>
</body>
</html>
