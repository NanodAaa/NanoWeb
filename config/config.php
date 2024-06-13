<?php 
$SERVER_NAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE_NAME = 'nanodb'
$BASE_DIR = 'D://NanodAaa/NanodAaa/';
$BOOK_DIR = 'D://NanodAaa/OPT/BOOK';
$CAPTURE_DIR = 'D://NanodAaa/VIDEO/CAPTURE';

function is_video($filepath) 
{
    $videoExtention = array('mp4', 'avi', 'mkv', 'webm', 'flv');
    if (file_exists($filepath)) 
    {
        $fileExtention = pathinfo($filepath, PATHINFO_EXTENSION);
        if (in_array($fileExtention, $videoExtention)) { return true; } 
        else { return false; }
    } else {
        echo 'File in ' . $filepath . ' doesnt exist';
        return false;
    }
}

function is_image($filepath)
{
    $imageExtention = array('jpg', 'png', 'gif');
    if (file_exists($filepath)) 
    {
        $fileExtention = pathinfo($filepath, PATHINFO_EXTENSION);
        if (in_array($fileExtention, $imageExtention)) { return true; } 
        else { return false; }
    } else {
        echo 'File in ' . $filepath . ' doesnt exist';
        return false;
    }
}
