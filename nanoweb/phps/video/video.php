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
$vid = $_GET["vid"];
$sql = "SELECT * FROM videos WHERE video_id = $vid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $videoName = $row["video_name"];
    $videoCollection = $row["video_collection"];
    $videoTags = $row["video_tags"];
    $videoFilename = $row["video_filename"];
}
$conn->close();
?>

<body class="body">
    <!-- LOGO -->
    <div class="logo">
        <h1 class="mainTitle"><a href="../index.php">NanoWeb</a></h1>
    </div>

    <!-- NAVIGATION -->
    <div class="navigation-container">
        <h3>NAVIGATION: <a href="../index.php?page=video">VIDEO</a> <a href="../index.php?page=manga">MANGA</a></h3>
    </div>

    <!-- VIDEO CONTAINER -->
    <div class="video-container">
        <video id="my-video" class="video-js" controls preload="auto" width="800" height="400" data-setup="{}">
            <source src="<?php echo ($videoFilename); ?>" type="video/mp4" />
        </video>
    </div>

    <!-- VIDEO INFO -->
    <div class="videoinfo-container">
        <h1>
            <?php echo ($videoName); ?><br>
            Collection: <?php echo ($videoCollection); ?><br>
            ID: <?php echo ($vid); ?><br>
            TAG: <?php echo ($videoTags); ?><br>
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