<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Unified Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 200px;
            background-color: #ffe6e6;
            position: fixed;
            height: 100%;
            overflow: auto;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: #ff69b4;
            padding: 16px;
            text-decoration: none;
            border-left: 4px solid transparent;
        }

        .sidebar a.active {
            background-color: #ffb3b3;
            color: white;
            border-left: 4px solid #ff69b4;
        }

        .sidebar a:hover:not(.active) {
            background-color: #ffcccc;
            color: #ff69b4;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
        }

        h1 {
            color: #ff69b4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ffe6e6;
            color: #ff69b4;
        }

        button {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #ff1493;
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
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            color: #ff69b4;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #ff1493;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="#" onclick="showDashboard('player')" class="active">Player Dashboard</a>
        <a href="#" onclick="showDashboard('club')">Club Dashboard</a>
        <a href="#" onclick="showDashboard('nationality')">Nationality Dashboard</a>
    </div>

    <div class="content" id="content">
        <div id="playerDashboard" style="display: block;">
            <h1>Player Dashboard</h1>
            <button onclick="openPopup('add', 'player')">Add New Player</button>
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
                include './CRUD/list_players.php';
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
                            <button onclick='openPopup(\"edit\", \"player\", {$player['playerID']})'><i class='fas fa-edit'></i></button>
                            <button onclick='deleteEntry(\"player\", {$player['playerID']})'><i class='fas fa-trash'></i></button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div id="clubDashboard" style="display: none;">
            <h1>Club Dashboard</h1>
            <button onclick="openPopup('add', 'club')">Add New Club</button>
            <table>
                <tr>
                    <th>Club ID</th>
                    <th>Club Name</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
                <?php
                include 'CRUD_team/listTeams.php';
                foreach ($teams as $team) {
                    echo "<tr>";
                    echo "<td>{$team['teamID']}</td>";
                    echo "<td>{$team['name']}</td>";
                    echo "<td><img src='{$team['logo']}' width='50'></td>";
                    echo "<td>
                            <button onclick='openPopup(\"edit\", \"club\", {$team['teamID']})'><i class='fas fa-edit'></i></button>
                            <button onclick='deleteEntry(\"club\", {$team['teamID']})'><i class='fas fa-trash'></i></button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div id="nationalityDashboard" style="display: none;">
            <h1>Nationality Dashboard</h1>
            <button onclick="openPopup('add', 'nationality')">Add New Nationality</button>
            <table>
                <tr>
                    <th>Nationality ID</th>
                    <th>Nationality Name</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
                <?php
                include 'CRUD_nationality/listNationalities.php';
                foreach ($nationalities as $nationality) {
                    echo "<tr>";
                    echo "<td>{$nationality['nationalityID']}</td>";
                    echo "<td>{$nationality['name']}</td>";
                    echo "<td><img src='{$nationality['flag']}' width='50'></td>";
                    echo "<td>
                            <button onclick='openPopup(\"edit\", \"nationality\", {$nationality['nationalityID']})'><i class='fas fa-edit'></i></button>
                            <button onclick='deleteEntry(\"nationality\", {$nationality['nationalityID']})'><i class='fas fa-trash'></i></button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <form id="entryForm" method="post">
                <input type="hidden" id="entryID" name="entryID">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="photo">Photo:</label>
                <input type="text" id="photo" name="photo" required><br>
                <!-- Additional fields for Player Dashboard -->
                <div id="playerFields" style="display: none;">
                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position"><br>
                    <label for="rating">Rating:</label>
                    <input type="number" id="rating" name="rating"><br>
                    <label for="pace">Pace:</label>
                    <input type="number" id="pace" name="pace"><br>
                    <label for="shooting">Shooting:</label>
                    <input type="number" id="shooting" name="shooting"><br>
                    <label for="passing">Passing:</label>
                    <input type="number" id="passing" name="passing"><br>
                    <label for="dribbling">Dribbling:</label>
                    <input type="number" id="dribbling" name="dribbling"><br>
                    <label for="defending">Defending:</label>
                    <input type="number" id="defending" name="defending"><br>
                    <label for="physical">Physical:</label>
                    <input type="number" id="physical" name="physical"><br>
                    <label for="teamName">Team Name:</label>
                    <select name="teamID" id="teamID">
                        <option value="" selected>Select a Club</option>
                        <?php
                        include 'selectTeamName.php';
                        foreach ($teams as $team) {
                            echo "<option value='$team[teamID]'>$team[teamName]</option>";
                        }
                        ?>
                    </select><br>
                    <label for="nationalityName">Nationality Name:</label>
                    <select name="nationalityID" id="nationalityID">
                        <option value="" selected>Select a nationality</option>
                        <?php
                        include 'selectNationalityName.php';
                        foreach ($nationalities as $nationality) {
                            echo "<option value='$nationality[nationalityID]'>$nationality[nationalityName]</option>";
                        }
                        ?>
                    </select><br>
                </div>
                <input type="submit" value="Save">
            </form>
        </div>
    </div>

    <script>
        function showDashboard(type) {
            document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
            document.querySelector(`.sidebar a[onclick="showDashboard('${type}')"]`).classList.add('active');
            document.querySelectorAll('#content > div').forEach(div => div.style.display = 'none');
            document.getElementById(`${type}Dashboard`).style.display = 'block';
        }

        function openPopup(action, type, entryID = null) {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('entryID').value = '';
            document.getElementById('name').value = '';
            document.getElementById('photo').value = '';
            document.getElementById('playerFields').style.display = type === 'player' ? 'block' : 'none';

            let formAction = '';
            if (type === 'player') {
                formAction = action === 'add' ? './CRUD/add_player.php' : './CRUD/update_player.php';
            } else if (type === 'club') {
                formAction = action === 'add' ? 'CRUD_team/addTeam.php' : 'CRUD_team/updateTeam.php';
            } else if (type === 'nationality') {
                formAction = action === 'add' ? 'CRUD_nationality/addNationality.php' : 'CRUD_nationality/updateNationality.php';
            }
            document.getElementById('entryForm').action = formAction;

            if (action === 'edit') {
                let fetchUrl = '';
                if (type === 'player') {
                    fetchUrl = './CRUD/get_player.php?playerID=' + entryID;
                } else if (type === 'club') {
                    fetchUrl = './CRUD_team/get_team.php?teamID=' + entryID;
                } else if (type === 'nationality') {
                    fetchUrl = './CRUD_nationality/getNationality.php?nationalityID=' + entryID;
                }
                fetch(fetchUrl)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('entryID').value = data.playerID || data.teamID || data.nationalityID;
                        document.getElementById('name').value = data.name;
                        document.getElementById('photo').value = data.photo || data.logo || data.flag;
                        if (type === 'player') {
                            document.getElementById('position').value = data.position;
                            document.getElementById('rating').value = data.rating;
                            document.getElementById('pace').value = data.pace;
                            document.getElementById('shooting').value = data.shooting;
                            document.getElementById('passing').value = data.passing;
                            document.getElementById('dribbling').value = data.dribbling;
                            document.getElementById('defending').value = data.defending;
                            document.getElementById('physical').value = data.physical;
                            document.getElementById('teamID').value = data.teamID;
                            document.getElementById('nationalityID').value = data.nationalityID;
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function deleteEntry(type, entryID) {
            if (confirm('Are you sure you want to delete this entry?')) {
                let deleteUrl = '';
                if (type === 'player') {
                    deleteUrl = './CRUD/delete_player.php?playerID=' + entryID;
                } else if (type === 'club') {
                    deleteUrl = './CRUD_team/deleteTeam.php?teamID=' + entryID;
                } else if (type === 'nationality') {
                    deleteUrl = './CRUD_nationality/deleteNationality.php?nationalityID=' + entryID;
                }
                window.location.href = deleteUrl;
            }
        }
    </script>
</body>

</html>
