<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <style>
        a{
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 32px;
        }
    </style>
</head>

<body>
    <!--  -->
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
        //$conn->close();

        // Form process
        $password = "";
        $ErrorInfo = "";

        if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            // Check if the password empty
            if (empty($_GET["password"])){
                $ErrorInfo = "Please enter username or password";
            }
        }
    ?>

    <div style="text-align: center;" class="linkP"><a href="http://192.168.31.72:80/NanodAaa/index.html">GNShelter Web</a></div>
    <div><h2 style="text-align: center;">SIGN UP</h1></div>

    <!-- SIGN UP FORM -->
    <div style="text-align: center;">
        <form action="./sign-up.php" method="get">
            USERNAME: <input type="text" name="username"><br>
            PASSWORD: <input type="password" name="password"><br>
            <span><?php echo $ErrorInfo; ?></span><br>
            <input type="submit" value="SIGN UP"><br>             
        </form>   

        <!-- PHP -->
        <?php
            if (isset($_GET["username"]) && isset($_GET["password"]))
            {
                $username = $_GET["username"];
                $password = $_GET["password"];
            //    echo "<h2>Your username is: {$username}<br> Your password is: {$password}<br></h2>";
                if (strlen(trim($username)) > 0 && strlen(trim($password)) > 0) 
                {
                    // Check the DB of the username
                    $sqlSelect = "select * from user";
                    $result = $conn->query($sqlSelect);   
                    if ($result->num_rows > 0)
                    {
                        $attr = $result->fetch_all(MYSQLI_ASSOC);
                    //    var_dump($attr);
                        $existFlag = false;
                        foreach ($attr as $row) 
                        {
                            // if username exist print error
                            if ($row['username'] == $username) 
                            {
                                echo "This username already exist!";
                                $existFlag = true;
                                break;
                            }
                        }
                        if (!$existFlag)
                        {                       
                            $sqlInsert = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
                            if ($conn->query($sqlInsert))
                            {
                                echo "Successfully sign up!";
                            }
                            else{
                                echo "Sign up error!";
                            }
                        }
                    }        
                }
            }
            $conn->close();
        ?>
    </div>
</body>
</html>
