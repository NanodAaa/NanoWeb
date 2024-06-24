<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Chrome">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>NanoWeb</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../webview/css/webview.css">
    <link rel="stylesheet" type="text/css" href="../webview/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<!-- MAIN -->

<body class="body">
    <div class="logo">
        <h1 class="mainTitle"><a href="./index.php">NanoWeb</a></h1>
    </div>

    <!-- SIGNIN BAR -->
    <div class="signInBar">
        <!-- Juage the login statement -->
        <!-- Logined -->
        <?php if (isset($_SESSION["username"])): ?>
            <h2><a href="./index.php?page=user">Welcome! [<?php echo $_SESSION['username']; ?>]</a> <a
                    href="./index.php?logout=true">Logout</a>
            </h2>
            <!-- Logout -->
            <?php
            if (isset($_GET["logout"])) {
                unset($_SESSION["username"]);
                echo ("Logout success!");
                unset($_GET["logout"]);
                header("Refresh: 0");
            }
            ?>

        <?php else: ?>
            <!-- Unlogined -->
            <!-- SignUp -->
            <form action="#" method="get">
                USERNAME: <input type="text" name="username">
                PASSWORD: <input type="password" name="password">
                <input type="submit" value="SIGN IN">
                <a href="../phps/usersystem/signup.php">SIGN UP</a>
            </form>

            <!-- SignIn -->
            <?php
            if (!isset($_GET["username"]) || empty($_GET["username"]) || !isset($_GET["password"]) || empty($_GET["password"])) {
                //    echo("Please input username and password.<br>");
            } else {
                include "./nanoweb_db/conn.php";
                $username = $_GET["username"];
                $password = $_GET["password"];
                $sql = "SELECT * FROM users WHERE username='$username' AND passwd='$password'";
                $result = $conn->query($sql);
                if (mysqli_num_rows($result)) {
                    //    echo "Signin success!";
                    $_SESSION["username"] = $username;
                    echo ("Signin success!");
                    header("Refresh: 0");
                } else {
                    echo ("Username or password incorrect!");
                }
                $conn->close();
            }
            ?>
        <?php endif ?>
    </div>

    <!-- NAVIGATION -->
    <div class="navigationBar">
        <h3>NAVIGATION: <a href="./index.php?page=video">VIDEO</a> <a href="./index.php?page=manga">MANGA</a></h3>
    </div>

    <!-- CONTAINER -->
    <div class="container">
        <?php if (isset($_GET["page"])): ?>
            <?php if ($_GET["page"] == "video"): ?>
                <!-- VIDEO PAGE -->
                <div>
                    <h1>VIDEO -- CAPTURE</h1>
                </div>

                <!-- SEARCH BAR -->
                <div class="searchBar">
                    <div>
                        <form method="GET" action="#">
                            <input type="hidden" name="page" value="video">
                            <input type="text" name="query" placeholder="search">
                            <button type="submit">SEARCH</button>
                        </form>
                    </div>
                </div>

                <!-- INFO BAR -->
                <div>
                    <?php
                    include "./nanoweb_db/conn.php";
                    if (!isset($_GET["query"]) || empty($_GET["query"])) {
                        /* Show All Videos */
                        $sql = "SELECT * FROM videos";
                    } else {
                        /* Search the keyword from nanoweb_db */
                        $query = $_GET["query"];
                        echo "<h2>Search result for $query:</h2>";
                        $sql = "SELECT * FROM videos WHERE video_name LIKE '%$query%' OR video_collection LIKE '%$query%'";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<table border='1'>";
                        echo "<tr>";
                        echo "<th>vid</th>";
                        echo "<th>Collection</th>";
                        echo "<th>Name</th>";
                        echo "</tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["video_id"] . "</td>";
                            echo "<td>" . $row["video_collection"] . "</td>";
                            echo "<td><a href='./video/video.php?vid=" . $row["video_id"] .
                                "'>" . $row["video_name"] . "</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 结果";
                    }
                    $conn->close();
                    ?>
                </div>

            <?php elseif ($_GET["page"] == "manga"): ?>
                <!-- MANGA PAGE -->
                <div>
                    <h1>MANGA</h1>
                </div>

            <?php elseif ($_GET["page"] == "user"): ?>
                <!-- USER PAGE -->
                <div>
                    <h1>USER PAGE -- <?php echo ($_SESSION["username"]) ?></h1>
                </div>
                <!-- FAVOURITE VIDEOS -->
                <div>
                    <h1>FAVOURITE VIDEOS:</h1>
                </div>

            <?php endif ?>

        <?php elseif (!isset($_GET["page"])): ?>
            <!-- DEFAULT PAGE -->
            <div>
                <h1>WELCOME TO NANOWEB!</h1>
            </div>

        <?php endif ?>
    </div>

</body>

</html>