<?php
include "../include/header.php";
// Login to nanodb
$conn = new mysqli($SERVER_NAME, $USERNAME, $PASSWORD, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Connection failed!". $conn->connect_error);
}
echo "Connect success!";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Chrome">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>NanoWeb</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="">
</head>

<!-- MAIN -->
<body>
    <h1 style="text-align: center;">NanoWeb</h1>

    <!-- SIGNIN BAR -->
    <div class="signinBar">
        <form action="./NanodAaa/account/sign-in.php" method="get">
            USERNAME: <input type="text" name="username">
            PASSWORD: <input type="password" name="password">
            <input type="submit" value="SIGN IN">     
            <a href="./NANOWEB/account/sign-up.php">SIGN UP</a>  
        </form>
    </div>

    <!-- NAVIGATION BAR -->
    <div>
        <h2>NAVIGATION</h2>
        <div>
<!--             <a href="./NANOWEB/videos/video-page.php">VIDEO</a><br>
            <a href="./NANOWEB/images/image-page.php">BOOK</a><br> -->
            <form method="GET" action="image-page.php">
            <a href=""></a>
        </form>
        </div>
    </div>
</body>

</html>