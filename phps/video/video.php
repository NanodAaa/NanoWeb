<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Chrome">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>NanoWeb</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../webview/css/webview.css">
    <link rel="stylesheet" type="text/css" href="../../webview/css/video.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
</head>

<!-- Find video data -->
<?php
include "../nanoweb_db/conn.php";



?>

<body class="body">
    <!-- LOGO -->
    <div class="logo">
        <h1 class="mainTitle"><a href="../index.php">NanoWeb</a></h1>
    </div>

    <div class="navigation-container">
        <h3>NAVIGATION: <a href="../index.php?page=video">VIDEO</a> <a href="../index.php?page=manga">MANGA</a></h3>
    </div>

    <!-- VIDEO CONTAINER -->
    <div class="video-container">
        <video id="my-video" class="video-js" controls preload="auto" width="800" height="400" data-setup="{}">
            <source src="<?php echo ($_GET["video"]); ?>" type="video/mp4" />
        </video>
    </div>

    <!-- VIDEO INFO -->
    <div class="videoinfo-container">
        <h1>
            <?php echo ($_GET["videoname"]); ?><br>
            Collection: <?php echo ($_GET["collection"]); ?><br>
            ID: <?php echo ($_GET["id"]); ?><br>
            TAG: <?php echo ($_GET["tag"]); ?><br>
        </h1>

    </div>

    <!-- COMMENT -->
    <div class="form-container">
        <form action="">
            <div class="form-group">
                <textarea id="commentText" rows="4" cols="50" placeholder="写下你的评论..."></textarea>
                <button id="submitComment">提交评论</button>
            </div>
        </form>
    </div>

</body>

</html>