<?php 
include 'connect.php' ;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Club Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <style> table { width: 100%; border-collapse: collapse; }

table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
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
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
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
