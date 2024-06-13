<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImageView</title>
    <style>
        /* 设置图片的宽度和高度 */
        /* 默认设置为每行显示3张图片 */
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        /* 媒体查询：页面宽度小于600px时，每行显示2张图片 */
        @media (max-width: 600px) {
            .gallery {
                justify-content: center;
            }
        }

        /* 媒体查询：页面宽度小于400px时，每行只显示1张图片 */
        @media (max-width: 400px) {
            .gallery {
                justify-content: center;
            }
        }

        /* 设置图片的宽度 */
        img {
            width: 300px; /* 设置图片的宽度为100像素 */
            height: auto; /* 让高度自适应，保持原始纵横比例 */
            margin: 10px; /* 设置图片之间的间距 */
            object-fit: cover;
        }

        /* 设置 div 元素的边框样式 */
        .box {
            border: 2px solid black; /* 边框样式为实线，颜色为黑色，宽度为2像素 */
            padding: 20px; /* 设置内边距 */
            width: auto; /* 设置宽度 */
            height: auto; /* 设置高度 */
        }

        .tag{
            max-width: 300px; /* 设置最大宽度 */
            max-height: 200px; /* 设置最大高度 */
        }
    </style>
</head>

<body>
    <div ><h1 style="text-align: center;">GNShelter Web</h1></div>

    <?php
    // Login to nanodb
    $servername = "localhost";;
    $username = "root";
    $password = "";
    $dbname = "nanodb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed!". $conn->connect_error);
    }

    // Get the key word
    $query = '';
    if (isset($_GET["query"])) 
    {
        $query = $_GET["query"];
        echo"<h2>Search result for $query:</h2>";
    }

    // 获取图片详情
    if(isset($_GET['book_name'])) 
    {
        $book_name = $_GET['book_name'];

        // 查询数据库获取图片详情信息
        $sql = "SELECT * FROM books WHERE book_name LIKE '%$book_name%'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>

    <!-- Book info -->
    <div class="box">
        <div>
            <h2><?php echo 'BOOK NAME: ' . $row["book_name"] ?></h2><br>
            <h3>COLLECTION: <?php echo $row["collection_name"]; ?></h3><br>
            <h3>CHARACTER: <?php echo $row["character_name"]; ?></h3><br>
        </div>
        <!-- TAG -->
        <div>
            <h2>TAG</h2>
        </div>
    </div>

    <!-- Book preview -->
    <div class="gallery; box">
        <div><h2>Book Preview</h2></div>
        <div>
        <?php
            while ($row = $result->fetch_assoc())
            {
                if ($result->num_rows > 0){
//                    echo "<img src='" . $row["file_name"] . "' alt='" . $row["book_name"] . "'>";
                    echo "<a href='detail.php?book_name=" . $row["book_name"] . "'>" . "<img src='" . $row["file_name"] . "' alt='" . $row["book_name"] . "'>" . '</a>';
                } else {
                    echo "Cannot find page";
                }
                
            }
            $conn->close();
        ?>
        </div>
    </div>


</body>

</html>