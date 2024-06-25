<?php session_start(); ?>

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
            <h1 class="mainTitle"><a href="../index.php">NanoWeb--AdminTerminal</a></h1>
        </div>

        <!-- TERMINAL -->
        <div>
            <!-- MENU -->
            <div class="sidebar">
                <ul>
                    <li>
                        <p onclick="menu_active('video')">VIDEO</p>
                        <!-- VIDEO -->
                        <ul id="video">
                            <li>UPLOAD VIDEO</li>
                            <li>MANGE VIDEO</li>
                        </ul>
                    </li>
                    <li>
                        <p onclick="menu_active('manga')">MANGA</p>
                        <!-- MANGA -->
                        <ul id="manga">
                            <li>UPLOAD MANGA</li>
                            <li>MANAGE MANGA</li>
                        </ul>
                    </li>
                </ul>

            </div>

            <br>

            <!-- FORM -->
            <div>
                <?php if (isset($_GET["page"])): ?>

                    <!-- VIDEO MANAGEMENT -->
                    <?php if ($_GET["page"] == "video"): ?>
                        <!-- FORM MENU -->
                        <div class="form-menu-container">

                        </div>

                        <div class="form-container">

                            <!-- UPLOAD VIDEO -->
                            <form action="../video/upload.php" method="get"><br>
                                VIDEO NAME: <input type="text" name="video_name"><br>
                                VIDEO COLLECTION: <input type="text" name="video_collection"><br>
                                VIDEO TAG: <input type="text" name="video_tag"><br>
                                VIDEO FILENAME: <input type="text" name="video_filename"><br>
                            </form>
                        </div>


                    <?php endif ?>

                <?php endif ?>
            </div>
        </div>
    </div>
</body>

</html>