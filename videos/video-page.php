<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/NanodAaa/webview/css/webView.css">
</head>

<body>
    <div ><h1 style="text-align: center;">GNShelter Web</h1></div>
    <!-- SYNC DATABASE -->
    <div><a href="../nanodb/syncdb-capture.php">SYNC DATABASE</a></div>

    <!-- SEARCH BAR -->
    <div>
        <form method="GET" action="video-page.php">
            <input type="text" name="query" placeholder="search">
            <button type="submit">SEARCH</button>
        </form>
    </div>

    <!-- INFO BAR -->
    <div>
        <?php
        include_once ("../config/config.php");
        // Get the key word
        $query = '';
        if (isset($_GET["query"])) 
        {
            $query = $_GET["query"];
            echo"<h2>Search result for $query:</h2>";
        }
        
        // Login to nanodb
        $dbname = "nanodb";
        $conn = new mysqli($SERVER_NAME, $USERNAME, $PASSWORD, $dbname);
        if ($conn->connect_error) {
            die("Connection failed!". $conn->connect_error);
        }

        // Search the keyword from nanodb
        /* $sql = "SELECT * FROM books WHERE book_name LIKE '%$query%' OR character_name LIKE '%$query%' OR collection_name LIKE '%$query%'"; */
        $sql = "SELECT * FROM captures WHERE capture_name LIKE '%$query%' OR collection_name LIKE '%$query%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            // 输出数据
            echo "<table border='1'>";
            echo "  <tr>
                    <th>cid</th>
                    <th>Collection</th>
                    <th>Name</th>                    
                    </tr>";
                    
            $preCapture = "";  // 
            while($row = $result->fetch_assoc()) 
            { 
                /* if ($preCapture == $row["collection_name"])
                {
                    continue;
                }
                $preCapture = $row["collection_name"]; */
                echo "<tr>";
                echo "<td>" . $row["capture_id"] . "</td>";
                echo "<td>" . $row["collection_name"] . "</td>";
//                echo "<td>" . "<a href='capture-view.php?file_name=" . $row["file_name"] . "'>" . $row["capture_name"] . "</a>" . "</td>";
                echo "<td>" . "<a href='" . $row["file_name"] . "'>" . $row["capture_name"] . "</a>" . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 结果";
        }

        ?>
    </div>
</body>

</html>