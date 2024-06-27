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
    $files = [];
    $dirContents = scandir($dir);

    // Get all the contents of the dir
    foreach ($dirContents as $item) 
    {
        if ($item != '.' && $item != '..') 
        {
            $path = $dir . '/' . $item;
            if (is_file($path)) {
                $files[] = $path;
            }
            elseif (is_dir($path)) {
                $subdirFiles = getAllFilePaths($path);
                $files = array_merge($files, $subdirFiles);
            }
        }
    }

    return $files;
}

echo "<h1>SYNC FILE</h1>";

// Connect to nanoDB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nanodb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed!" . $conn->connect_error);
}

$dir = $BOOK_DIR;
$allFilePaths = getAllFilePaths($dir);

//DEBUG
/* $sql = "SELECT book_name, page_number FROM books";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // 输出数据
    while ($row = $result->fetch_assoc()) {
        var_dump($row);
    }
} else {
    echo "0 结果";
} */

foreach ($allFilePaths as $filepath) 
{
    // Form the result
    $dirName = dirname($filepath);
    $parts = explode("/", $dirName);

    $collection_name = mysqli_real_escape_string($conn, $parts[5]);
    $character_name = mysqli_real_escape_string($conn, $parts[6]);
    $book_name = mysqli_real_escape_string($conn, $parts[7]);
    $page_number = pathinfo($filepath, PATHINFO_FILENAME);
    $filename = "../../" . $parts[3] . '/' . $parts[4] . '/' . $parts[5] . '/' . $parts[6] . '/' . $parts[7] . '/' . basename($filepath);
    $file_name = mysqli_real_escape_string($conn, $filename);
    
//  DEBUG
//    echo "Col " . $collection_name . "<br>";
//    echo "Cha " . $character_name . "<br>";
//    echo "Bn " . $book_name . "<br>";
//    echo "Pn " . $page_number . "<br>";
    echo "Fn " . $file_name;

    // Check the database and dir
    $sql = "SELECT * FROM books WHERE book_name='$book_name' AND page_number='$page_number'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "(exist)<br>";
    } else {
        //    echo "No value exists in the database.";
        echo "<br>";
        $sql = "INSERT INTO books (book_name, collection_name, character_name, page_number, file_name) VALUES ('$book_name', '$collection_name', '$character_name', '$page_number', '$file_name')";
        $conn->query($sql);
    }
}

echo "<h1>UPLOAD PROCESS COMPLETE!</h1>";
$conn->close();
