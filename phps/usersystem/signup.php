<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NanoWeb</title>
    <link rel="stylesheet" href="../../webview/css/webview.css">
</head>

<body>
    <div class="mainTitle"><h1>NanoWeb</h1></div>
    <div>
        <form action="./signup.php" method="get">
        USERNAME: <input type="text" name="username">
        PASSWORD: <input type="password" name="password">
        <input type="submit" value="SIGN UP">
        <a href="../index.php">NANOWEB</a><br>
        </form>
    </div>
    
</body>

<?php
include "../../nanoweb_db/conn.php";

if ($_GET["username"] == '' || $_GET["password"] == '')
{
    die("Please input correct username or password!");
}
$username = $_GET["username"];
$password = $_GET["password"];
// echo $username, $password;

/* Check if the user is exist */
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    die("Username exist!<br>");
}

/* Upload userinfo to database */
$sql = "INSERT INTO users (username, passwd) VALUES ( '$username', '$password')";
$result = $conn->query($sql);
if (!$result){
    die("Mysql Error");
} else {
    echo "Signup success!";
}

$conn->close();
?>

</html>