<?php
include 'connect.php';  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            <a href="#"><span class="menu-icon">👤</span> Profile</a>
        </li>
        <li class="menu-item">
            <a href="#"><span class="menu-icon">🔓</span> Sign In</a>
        </li>
        <li class="menu-item">
            <a href="#"><span class="menu-icon">📝</span> Sign Up</a>
        </li>
    </ul>
</div>


<script>

  function loadContent(type) {


      let url = '';
      switch (type) {
          case 'player':
              url = 'dashboard.php';
              break;
          case 'club':
              url = './teamTable.php';
              break;
          case 'nationality':
              url = 'nationalityTable.php';
              break;
          default:
              url = 'home.php';
      }

     
  }


  
</script>

</body>

</html>
