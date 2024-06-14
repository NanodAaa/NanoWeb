<?php
include "../include/header.php";
// Login to nanodb
$conn = new mysqli($SERVER_NAME, $USERNAME, $PASSWORD, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Connection failed!". $conn->connect_error);
}
// echo "Connect success!";
?>

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
    <h1 style="text-align: center;">NanoWeb</h1>

    <!-- SIGNIN BAR -->
    <div class="signInBar">
        <form action="./index_new.php" method="post">
            USERNAME: <input type="text" name="username">
            PASSWORD: <input type="password" name="password">
            <input type="submit" value="SIGN IN">     
            <a href="./index_new.php?page=signup_page">SIGN UP</a>  
        </form>
    </div>

    <?php

    ?>

    <!-- NAVIGATION BAR -->
    <div class="navigationBar">
        <h2>NAVIGATION</h2>
        <div>
            <h3>OLD NAVIGATION:</h3>
            <a href="../videos/video-page.php">VIDEO</a><br>
            <a href="../images/image-page.php">BOOK</a><br>
            <h3>NEW NAVIGATION:</h3>
            <form method="GET" action="image-page.php">
            <a href=""></a>
        </form>
        </div>
    </div>

</body>

</html>