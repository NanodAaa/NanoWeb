<?php 

/* Admin */
$ADMIN_USERNAME = "admin";
$ADMIN_PASSWORD = "123456";

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
