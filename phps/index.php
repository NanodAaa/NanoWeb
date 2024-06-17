<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Chrome">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>NanoWeb</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../webview/css/webview.css">
</head>

<!-- MAIN -->
<body>
    <div><h1 style="text-align: center;">NanoWeb</h1></div>

    <!-- SIGNIN BAR -->
    <div class="signInBar">
        <!-- Juage the login statement -->
        <?php if (isset($_SESSION["username"])) : ?>
            <a href="#">Welcome! [<?php echo $_SESSION['username']; ?>]</a>
            <a href="../phps/usersystem/logout.php">Logout</a>

        <?php else: ?>
            <form action="./index.php" method="get">
                USERNAME: <input type="text" name="username">
                PASSWORD: <input type="password" name="password">
                <input type="submit" value="SIGN IN">     
                <a href="../phps/usersystem/signup.php">SIGN UP</a>  
            </form>

            <?php
            // Signin
            include "../nanoweb_db/conn.php";
            if ($_GET["username"] == '' || $_GET["password"] == ''){
                echo ("Please input correct username or password!<br>");
            }

            $username = $_GET["username"];
            $password = $_GET["password"];
            $sql = "SELECT * FROM users WHERE username='$username' AND passwd='$password'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result)){
                echo "Signin success!";
                $_SESSION["username"] = $username;
            } else {
                echo ("Username or password incorrect!");
            }
            ?>
        <?php endif ?>
    </div>

    <!-- NAVIGATION BAR -->
    <div class="navigationBar">
        <h2>NAVIGATION</h2>
        <div>
            <h3>OLD NAVIGATION:</h3>
            <a href="../videos/video-page.php">VIDEO</a><br>
            <a href="../images/image-page.php">BOOK</a><br>
            <h3>NEW NAVIGATION:</h3>
            <a href="./index.php">NANOWEB</a><br>
            <a href="./index.php?page=video_page">VIDEO</a><br>
            <a href="./index.php?page=manga_page">MANGA</a><br>
        </form>
        </div>
    </div>

    <?php
        echo $_GET["page"];
    ?>

</body>

</html>