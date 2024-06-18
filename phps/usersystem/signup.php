<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NanoWeb</title>
    <link rel="stylesheet" href="../../webview/css/webview.css">
</head>

<body>
    <div class="mainTitle">
        <h1><a href="../index.php">NanoWeb</a></h1>
    </div>
    <div class="signUpBar">
        <form action="./signup.php" method="get">
            USERNAME: <input type="text" name="username"><br>
            PASSWORD: <input type="password" name="password"><br>
            <input type="submit" value="SIGN UP"><br>
        </form>
    </div>

</body>

<?php
include "../../nanoweb_db/conn.php";

if (!isset($_GET["username"]) || empty($_GET["username"]) || !isset($_GET["password"]) || empty($_GET["password"])) {
    die("<h3 style='text-align: center'>Please input username and password!</h3>");
}
$username = $_GET["username"];
$password = $_GET["password"];
// echo $username, $password;

/* Check if the user is exist */
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    die("<h3 style='text-align: center'>Username exist!</h3><br>");
}

/* Upload userinfo to database */
$sql = "INSERT INTO users (username, passwd) VALUES ( '$username', '$password')";
$result = $conn->query($sql);
if (!$result) {
    die("<h3 style='text-align: center'>Mysql Error</h3>");
} else {
    echo "<h3 style='text-align: center'>Signup success!</h3>";
}

$conn->close();
?>

</html>