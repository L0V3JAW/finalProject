<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $host = "localhost";
    $username = "root"; 
    $password = "sesame";
    $database = "campers_unite";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";

        if ($conn->query($sql) === TRUE) {
            echo '"' . $title . '" post has been created!';
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Campers Unite! | Create new post</title>
    </head>
    <body>
        <nav>
            <ul>
                <li style="display: inline"><a href="register.php">Register |</a></li>
                <li style="display: inline"><a href="login.php">Login |</a></li>
                <li style="display: inline"><a href="readpost.php">Read Posts |</a></li>
                <li style="display: inline"><a href="createpost.php">Create Post</a></li>
            </ul>    
        </nav>
        <h1>Hello, <?php echo $_SESSION['username']; ?>.</h1>
        <h2>What would you like to post today?</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Title goes here..." required><br><br>
            <textarea name="content" placeholder="Let us hear it!" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Create Post!"><br><br>
        </form>
        <a href="logout.php">Logout</a>
    </body>
</html> 