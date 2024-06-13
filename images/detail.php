<!DOCTYPE html>
<html>
<head>
    <title>ImageViewer</title>
    <style>
        /* 设置图片的最大宽度和最大高度，以及居中显示 */
        img {
            max-width: 100%; /* 图片的最大宽度为窗口宽度 */
            max-height: 100%; /* 图片的最大高度为窗口高度 */
            width: auto; /* 图片宽度自适应 */
            height: auto; /* 图片高度自适应 */
            display: block; /* 设置图片为块级元素，以便居中显示 */
            margin: 0 auto; /* 水平居中显示 */
        }
    </style>
</head>
<body>

<?php
// 连接数据库
$servername = "localhost";;
$username = "root";
$password = "";
$dbname = "nanodb";

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取图片详情
if(isset($_GET['book_name'])) {
    $book_name = $_GET['book_name'];

    // 查询数据库获取图片详情信息
    $sql = "SELECT * FROM books WHERE book_name LIKE '%$book_name'";
//    $sql = "SELECT * FROM books WHERE book_name LIKE '%$query%' OR character_name LIKE '%$query%' OR collection_name LIKE '%$query%'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
        if ($result->num_rows > 0){
            echo "<img src='" . $row["file_name"] . "' alt='" . $row["book_name"] . "'><br>";
        } else {
            echo "Cannot find page";
        }
        
    }
}

// 关闭数据库连接
$conn->close();
?>

</body>
</html>