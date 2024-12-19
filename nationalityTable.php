<!DOCTYPE html>
<html>

<head>
    <title>Nationality Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

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
    <h1>Nationality Dashboard</h1>
    <button onclick="openPopup('add')">Add New Nationality</button>
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
                    <button onclick='openPopup(\"edit\", {$nationality['nationalityID']})'><i class='fas fa-edit'></i></button>
                    <button onclick='deleteNationality({$nationality['nationalityID']})'><i class='fas fa-trash'></i></button>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <form id="nationalityForm" method="post">
                <input type="hidden" id="nationalityID" name="nationalityID">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="photo">Photo:</label>
                <input type="text" id="flag" name="flag" required><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <script>
        function openPopup(action, nationalityID = null) {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('nationalityForm').action = action === 'add' ? 'CRUD_nationality/addNationality.php' : 'CRUD_nationality/updateNationality.php';
            document.getElementById('nationalityID').value = '';
            document.getElementById('name').value = '';
            document.getElementById('flag').value = '';

            if (action === 'edit') {
                fetch('./CRUD_nationality/getNationality.php?nationalityID=' + nationalityID)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nationalityID').value = data.nationalityID;
                        document.getElementById('name').value = data.name;
                        document.getElementById('flag').value = data.flag;
                    })
                    .catch(error => console.error('Error fetching nationality data:', error));
            }
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function deleteNationality(nationalityID) {
            if (confirm('Are you sure you want to delete this nationality?')) {
                window.location.href = './CRUD_nationality/deleteNationality.php?nationalityID=' + nationalityID;
            }
        }
    </script>
</body>

</html>
