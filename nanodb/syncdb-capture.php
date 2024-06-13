<!-- Sync the database and folder -->
<?php
include_once ("./conn.php");
include_once ("../config/config.php");
set_time_limit(0);

// Get all files' path
// @param $dir Directories path
// @return array[file1_path, ...]
function getAllFilePaths($dir)
{
    $files = array();
    $dirContents = scandir($dir);

    // Get all the contents of the dir
    foreach ($dirContents as $item) 
    {
        if ($item != '.' && $item != '..') 
        {
            $path = $dir . '/' . $item;
            if (is_file($path)) {
                if (is_video($path)) {
                    $files[] = $path;
                }
            }
            elseif (is_dir($path)) {
                $subdirFiles = getAllFilePaths($path);
                $files = array_merge($files, $subdirFiles);
            }
        }
    }

    return $files;
}

function arrayCompare($arr1, $arr2, $key)
{
    $arrA = $arr1;
    $arrB = $arr2;
    foreach ($arr1 as $k => $v) {
        foreach ($arr2 as $k2 => $v2) {
            if ($v[$key] == $v2[$key]) {
                unset($arrA[$k]);
                unset($arrB[$k2]);
            }
        }
    }
    return array_merge($arrA, $arrB);
}

// MAIN
echo "<h1>SYNC FILE</h1>";

// Connect to nanoDB
$dbname = "nanodb";
$conn = new mysqli($SERVER_NAME, $USERNAME, $PASSWORD, $dbname);
if ($conn->connect_error) {
    die("Connection failed!" . $conn->connect_error);
}

// Get file in filesystem
$dir = $CAPTURE_DIR;
$allFilePaths = getAllFilePaths($dir);
//var_dump($allFilePaths);

// Form the file
$filesInSystem = array();
foreach ($allFilePaths as $filepath) 
{
    $dirName = dirname($filepath);
    $parts = explode("/", $dirName);
    $partNum = count($parts);

    /* $capture_collection = mysqli_real_escape_string($conn, $parts[$partNum - 1]);
    $capture_name = mysqli_real_escape_string($conn, pathinfo($filepath, PATHINFO_FILENAME)); */
    $capture_collection = $parts[$partNum - 1];
    $capture_name = pathinfo($filepath, PATHINFO_FILENAME);

//    $fileParts = array();
    $fileParts = array_slice($parts, 3);
    $file_name = "http://localhost/";
    foreach ($fileParts as $part)
    {
        $file_name .= $part . '/';
    }
    $file_name .= basename($filepath);
//    $file_name = mysqli_real_escape_string($conn, $file_name);

    $filesInSystem[] = array($capture_collection, $capture_name, $file_name);
    
//  DEBUG
    /* echo "CC " . $capture_collection . "<br>";
    echo "CN " . $capture_name . "<br>";
    echo "FN " . $file_name . "<br>";
    die(); */
}

// Get files info from database
$sql = "SELECT collection_name, capture_name, file_name FROM captures";
$result = $conn->query($sql);
var_dump($result);
$fileInDB = array();
if ($result->num_rows == true) {
    $fileInDB = mysqli_fetch_all($result);
} else {
    echo "<h2>Database is empty</h2>";
}

echo "<h1>" . "THE FILES IN DATABASE" . "</h1><br>";
var_dump($fileInDB);
echo "<h1>" . "THE FILES IN FILESYSTEM" . "</h1><br>";
var_dump($filesInSystem);

$fileToRemove = arrayCompare($fileInDB, $filesInSystem, 2);
$fileToUpload = arrayCompare($filesInSystem, $fileInDB, 2);

echo "<h1>" . "THE FILES NEED TO REMOVE FROM DATABASE" . "</h1><br>";
var_dump($fileToRemove);
echo "<h1>" . "THE FILES NEED TO UPLOAD TO DATABASE" . "</h1><br>";
var_dump($fileToUpload);

echo "<h1>" . "SYNCING" . "</h1><br>";
// Remove files
foreach ($fileToRemove as $file) {
    $sql = "DELETE FROM captures WHERE collection_name='$file[0]' AND capture_name='$file[1]' AND file_name='$file[2]'";
    $conn->query($sql);
}

foreach ($fileToUpload as $file) {
    $sql = "INSERT INTO captures (collection_name, capture_name, file_name) VALUES ('$file[0]', '$file[1]', '$file[2]')";
    $conn->query($sql);
}

echo "<h1>UPLOAD PROCESS COMPLETE!</h1>";
$conn->close();
