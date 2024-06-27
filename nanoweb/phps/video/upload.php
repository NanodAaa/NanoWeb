<?php
include "./nanoweb_db/conn.php";

$video_name = $_GET['video_name'];
$video_collection = $_GET['video_collection'];
$video_tags = $_GET['video_tags'];
$video_filename = $_GET['video_filename'];

$sql = "INSERT INTO videos (video_name, video_collection, video_tags, video_filename) VALUES ('$video_name', '$video_collection', '$video_tags', '$video_filename')";
$result = $conn->query($sql);
if ($result) {
    echo "Video uploaded successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$conn->close();