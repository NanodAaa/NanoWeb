<?php
session_start();
unset($_SESSION['username']);
//header('Location : /index.php');
echo "<script>window.location.href='index.php'</script>";