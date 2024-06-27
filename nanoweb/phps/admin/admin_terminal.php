<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Chrome">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>NanoWeb--AdminTerminal</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../webview/css/webview.css">
    <link rel="stylesheet" type="text/css" href="../../webview/css/admin_terminal.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- JS -->
    <script src="../../include/admin_terminal_header.js"></script>

</head>

<body>
    <div>
        <!-- LOGO -->
        <div class="logo">
            <h1><a href="../index.php">NanoWeb</a>--<a href="./admin_terminal.php">AdminTerminal</a></h1>
        </div>

        <!-- TERMINAL -->
        <div class="box">
            <!-- SIDEBAR -->
            <div class="sidebar">
                <ul>
                    <li>
                        <!-- VIDEO -->
                        <p onclick="menu_active('video')">VIDEO</p>                        
                        <ul id="video">
                            <li><a href="./admin_terminal.php?mod=upload_video">UPLOAD VIDEO</a></li>
                            <li><a href="./admin_terminal.php?mod=manage_video">MANAGE VIDEO</a></li>
                        </ul>
                    </li>
                    <li>
                        <!-- MANGA -->
                        <p onclick="menu_active('manga')">MANGA</p>                      
                        <ul id="manga">
                            <li><a href="./admin_terminal.php?mod=upload_manga">UPLOAD MANGA</a></li>
                            <li><a href="./admin_terminal.php?mod=manage_manga">MANAGE MANGA</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- FORM CONTAINER -->
            <div class="form-container">
                <div>
                    <h2 style="text-align: center;">
                        <?php
                        if (isset($_GET["mod"])) {
                            if ($_GET["mod"] == "upload_video") {
                                echo ("UPLOAD VIDEO");
                            } else if ($_GET["mod"] == "manage_video") {
                                echo ("MANAGE VIDEO");
                            }
                        } else {
                            echo ("ADMIN TERMINAL");
                        }
                        ?>
                    </h2>
                </div>

                <!-- FORM -->
                <div class="form">
                    <?php if (!isset($_GET["mod"]) || empty($_GET["mod"])): ?>

                    <?php else: ?>
                        <?php if ($_GET["mod"] == "upload_video"): ?>
                            <!-- UPLOAD VIDEO -->
                            <form action="admin_terminal.php" method="get">
                                <input type="hidden" name="mod" value="upload_video" />

                                <label for="video_name">VIDEO NAME: </label>
                                <input type="text" id="video_name" name="video_name" /><br><br>

                                <label for="video_collection">VIDEO COLLECTION: </label>
                                <input type="text" id="video_collection" name="video_collection" /><br><br>

                                <label for="video_tags">VIDEO TAGS: </label>
                                <input type="text" id="video_tags" name="video_tags" /><br><br>

                                <label for="video_filename">VIDEO FILENAME: </label>
                                <input type="text" id="video_filename" name="video_filename" /><br><br>

                                <input type="submit" value="UPLOAD" />
                            </form>

                        <?php elseif ($_GET["mod"] == "manage_video"): ?>
                            <!-- MANAGE VIDEO -->
                            <form action="#" method="get">

                            </form>

                        <?php endif ?>
                    <?php endif ?>
                </div>

                <!-- PHP -->
                <?php
                if (!isset($_GET["mod"]) || empty($_GET["mod"])) {
                } else {
                    /* UPLOAD VIDEO */
                    if ($_GET["mod"] == "upload_video") {
                        if (!isset($_GET["video_name"]) || !isset($_GET["video_collection"]) || !isset($_GET["video_tags"]) || !isset($_GET["video_filename"])) {
                            echo ("Please fill all fields.");
                        } else {
                            $video_name = $_GET["video_name"];
                            $video_collection = $_GET["video_collection"];
                            $video_tags = $_GET["video_tags"];
                            $video_filename = $_GET["video_filename"];

                            include "../nanoweb_db/conn.php";
                            $sql = "INSERT INTO videos (video_name, video_collection, video_tags, video_filename) 
                                        VALUES ('$video_name', '$video_collection', '$video_tags', '$video_filename')";
                            $result = $conn->query($sql);
                            if ($result) {
                                echo ("Video uploaded successfully.");
                            } else {
                                echo ("Error: " . $sql . "<br>" . $conn->error);
                            }
                            $conn->close();
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>