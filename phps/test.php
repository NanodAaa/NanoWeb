<!DOCTYPE html>
<html>

<head>
    <title>Collapsible Sidebar Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: #fff;
            transition: width 0.3s;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            text-align: left;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li:hover {
            background-color: #575757;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .toggle-btn {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>
    <?php
    $menuItems = [
        ["name" => "Home", "url" => "home.php"],
        ["name" => "About", "url" => "about.php"],
        ["name" => "Services", "url" => "services.php"],
        ["name" => "Contact", "url" => "contact.php"]
    ];
    ?>

</head>

<body>
    <div class="sidebar" id="sidebar">
        <ul>
            <?php foreach ($menuItems as $item): ?>
                <li><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="content">
        <button class="toggle-btn" onclick="toggleSidebar()">Toggle Menu</button>
        <h1>Welcome to My Website</h1>
        <p>Content goes here...</p>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>

</html>