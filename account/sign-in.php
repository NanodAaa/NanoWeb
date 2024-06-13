<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();

// Login algrothim
if (isset($_GET["username"]) && isset($_GET["password"])) 
{
    $username = $_GET["username"];
    $password = $_GET["password"];
    if (strlen(trim($username)) > 0 && strlen(trim($password)) > 0) 
    {
        // Haven't registed create an account
        if (!$_SESSION["username"]) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            echo "<h1>Dear {$_SESSION["username"]}. You are sucessfully login!<br></h1>";
            echo "<h2>Your password is: {$_SESSION["password"]}<br></h2>";
        }           

        // Registerd
        else if ($username == $_SESSION["username"]) 
        {
            // 
            if ($password == $_SESSION["password"]) {
            //    unset($_SESSION["username"]);
                echo "<h1>Dear {$_SESSION["username"]}. You have already logined!<br></h1>";
            } else {
                echo "<h1>Username or password is not correct!<br></h1>";
            }
        } else {
            echo "<h1>Username or password is not correct!<br></h1>";
        }
    }
} else {
    echo "<h1>LOGIN ERROR!</h1>";
}
