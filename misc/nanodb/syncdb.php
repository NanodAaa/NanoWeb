<!-- Sync the database and folder -->
<!-- Image page -->
<!-- 2024/5/4 -->

<?php
include_once ("./conn.php");
include_once ("../config/config.php");
set_time_limit(0);

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

// Get all files' path
// @param $dir Directories path
// @return array[file1_path, ...]
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
                if (is_image($path)) {
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

// MAIN
echo "<h1>SYNC FILE</h1>";

// Connect to nanoDB
$dbname = "nanodb";
$conn = new mysqli($SERVER_NAME, $USERNAME, $PASSWORD, $dbname);
if ($conn->connect_error) {
    die("Connection failed!" . $conn->connect_error);
}

// Get file in filesystem
$dir = $BOOK_DIR;
$allFilePaths = getAllFilePaths($dir);
$filesInSystem = array();

foreach ($allFilePaths as $filepath) 
{
    // Form the result
    $dirName = dirname($filepath);
    $parts = explode("/", $dirName);
    $partNum = count($parts);
    $collection_name = $parts[$partNum - 3];
    $character_name = $parts[$partNum - 2];
    $book_name = $parts[$partNum - 1];
    $page_number = pathinfo($filepath, PATHINFO_FILENAME);

    $fileParts = array();
    $fileParts = array_slice($parts, 3);
    $file_name = "http://localhost/";
    foreach ($fileParts as $part)
    {
        $file_name .= $part . '/';
    }
    $file_name .= basename($filepath);

    $filesInSystem[] = array($collection_name, $character_name, $book_name, $page_number, $file_name);
    
//  DEBUG
//    echo "Col " . $collection_name . "<br>";
//    echo "Cha " . $character_name . "<br>";
//    echo "Bn " . $book_name . "<br>";
//    echo "Pn " . $page_number . "<br>";
//    echo $file_name . "<br>";
}

// Get files info from database
$sql = "SELECT collection_name, character_name, book_name, page_number, file_name FROM books";
$result = $conn->query($sql);
$fileInDB = mysqli_fetch_all($result);

$fileToRemove = array();
$fileToRemove = arrayCompare($fileInDB, $filesInSystem, 2);
$fileToUpload = array();
$fileToUpload = arrayCompare($filesInSystem, $fileInDB, 2);

echo "<h1>" . "THE FILES NEED TO REMOVE FROM DATABASE" . "</h1><br>";
var_dump($fileToRemove);
echo "<h1>" . "THE FILES NEED TO UPLOAD TO DATABASE" . "</h1><br>";
var_dump($fileToUpload);


// Remove files
foreach ($fileToRemove as $file) {
    $sql = "DELETE FROM books WHERE collection_name='$file[0]' AND character_name='$file[1]' AND book_name='$file[2]' AND page_number='$file[3]'";
    $conn->query($sql);
}

// Upload files
foreach ($fileToUpload as $file) {
    $sql = "INSERT INTO books (book_name, collection_name, character_name, page_number, file_name) VALUES ('$file[2]', '$file[0]', '$file[1]', '$file[3]', '$file[4]')";
    $conn->query($sql);
}

echo "<h1>UPLOAD PROCESS COMPLETE!</h1>";
$conn->close();
