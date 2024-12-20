<!DOCTYPE html>
<html>

<head>
    <title>Nationality Dashboard</title>
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
