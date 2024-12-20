<?php 
include 'connect.php' ;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Club Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
          body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar-header {
            margin-bottom: 20px;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 5px;
            transition: background-color 0.3s;
        }

        .menu-item.active,
        .menu-item:hover {
            background-color: #e0e0e0;
        }

        .menu-icon {
            margin-right: 10px;
        }

        .account-section {
            margin: 20px 0 10px;
            font-size: 14px;
            font-weight: bold;
            color: #777;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
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
    <div class="sidebar-header">
        <!-- You can add a logo or text here -->
    </div>
    <ul class="sidebar-menu">
        <li class="menu-item active" id="homePage" onclick="loadContent('home')">
            <span class="menu-icon">📊</span> Home
        </li>
        <li class="menu-item" id="playersPage" onclick="loadContent('player')">
            <span class="menu-icon">📋</span> Players
        </li>
        <li class="menu-item" id="clubsPage" onclick="loadContent('club')">
            <span class="menu-icon">💳</span> Clubs
        </li>
        <li class="menu-item" id="nationalitiesPage" onclick="loadContent('nationality')">
            <span class="menu-icon">🌌</span> Nationalities
        </li>
    </ul>
    <h4 class="account-section">Account Pages</h4>
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="profile.php"><span class="menu-icon">👤</span> Profile</a>
        </li>
        <li class="menu-item">
            <a href="signin.php"><span class="menu-icon">🔓</span> Sign In</a>
        </li>
        <li class="menu-item">
            <a href="signup.php"><span class="menu-icon">📝</span> Sign Up</a>
        </li>
    </ul>
</div>


    <h1>Club Dashboard</h1>
    <button onclick="openPopup('add')">Add New Club</button>
    <table>
        <tr>
            <th>Club ID</th>
            <th>Club Name</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>

        <?php
        include './CRUD_team/listTeams.php';
        foreach ($teams as $team) {
            echo "<tr>";
            echo "<td>{$team['teamID']}</td>";
            echo "<td>{$team['name']}</td>";
            echo "<td><img src='{$team['logo']}' width='50'></td>";
            echo "<td>
                    <button onclick='openPopup(\"edit\", {$team['teamID']})'><i class='fas fa-edit'></i></button>
                    <button onclick='deleteTeam({$team['teamID']})'><i class='fas fa-trash'></i></button>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <form id="teamForm" method="post">
                <input type="hidden" id="teamID" name="teamID">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="photo">Photo:</label>
                <input type="text" id="logo" name="logo" required><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <script>
          function loadContent(type) {
      document.querySelectorAll('.menu-item').forEach(item => {
          item.classList.remove('active');
      });

      const clickedItem = document.querySelector(`#${type}Page`);
      if (clickedItem) {
          clickedItem.classList.add('active');
      }

      let url = '';
      switch (type) {
          case 'player':
              url = 'dashboard.php';
              break;
          case 'club':
              url = 'teamTable.php';
              break;
          case 'nationality':
              url = 'nationalityTable.php';
              break;
          default:
              url = 'home.php';
      }

     
  }

        function openPopup(action, teamID = null) {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('teamForm').action = action === 'add' ? 'CRUD_team/addTeam.php' : 'CRUD_team/updateTeam.php';
            document.getElementById('teamID').value = '';
            document.getElementById('name').value = '';
            document.getElementById('logo').value = '';

            if (action === 'edit') {
                fetch('./CRUD_team/get_team.php?teamID=' + teamID)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('teamID').value = data.teamID;
                        document.getElementById('name').value = data.name;
                        document.getElementById('logo').value = data.logo;
                    })
                    .catch(error => console.error('Error fetching team data:', error));
            }
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function deleteTeam(teamID) {
            if (confirm('Are you sure you want to delete this team?')) {
                window.location.href = './CRUD_team/deleteTeam.php?teamID=' + teamID;
            }
        }
    </script>
</body>

</html>
