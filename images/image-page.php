<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="D://NanodAaa/NanodAaa/webview/css/webView.css">
</head>

<body>
    <div ><h1 style="text-align: center;">GNShelter Web</h1></div>
    <!-- SYNC DATABASE -->
    <div><a href="../nanodb/sync-db-folder.php">Sync Book</a></div>
    <div><a href="../nanodb/syncdb.php">SYNC DATABASE</a></div>

    <!-- SEARCH BAR -->
    <div>
        <form method="GET" action="image-page.php">
            <input type="text" name="query" placeholder="search">
            <button type="submit">SEARCH</button>
        </form>
    </div>

    <!-- INFO BAR -->
    <div>
        <?php
        // Get the key word
        $query = '';
        if (isset($_GET["query"])) 
        {
            $query = $_GET["query"];
            echo"<h2>Search result for $query:</h2>";
        }
        
        // Login to nanodb
        $servername = "localhost";;
        $username = "root";
        $password = "";
        $dbname = "nanodb";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed!". $conn->connect_error);
        }

        // Search the keyword from nanodb
        $sql = "SELECT * FROM books WHERE book_name LIKE '%$query%' OR character_name LIKE '%$query%' OR collection_name LIKE '%$query%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            // 输出数据
            echo "<table border='1'>";
            echo "  <tr>
                    <th>bid</th>
                    <th>Collection</th>
                    <th>Chara</th>
                    <th>Name</th>                    
                    </tr>";
                    
            $preBook = "";  // 
            while($row = $result->fetch_assoc()) 
            { 
                if ($preBook == $row["book_name"])
                {
                    continue;
                }
                $preBook = $row["book_name"];
                echo "<tr>";
                echo "<td>" . $row["book_id"] . "</td>";
                echo "<td>" . $row["collection_name"] . "</td>";
                echo "<td>" . $row["character_name"] . "</td>";
//                echo "<td>" . "<a href='detail.php?book_name=" . $row["book_name"] . "'>" . $row["book_name"] . "</a>" . "</td>";
                echo "<td>" . "<a href='image-view.php?book_name=" . $row["book_name"] . "'>" . $row["book_name"] . "</a>" . "</td>";
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