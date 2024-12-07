<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $host = 'localhost';
    $username = 'root';   
    $password = 'sesame';   
    $database = 'campers_unite';  

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT username, title, content, created_at FROM users, posts WHERE users.id = posts.user_id ORDER BY created_at DESC";
    $result = $conn->query($sql);    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Campers Unite! | Posts</title>
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
        <h2>Which post would you like to read today?</h2>
        <h2>**************</h2><br>
        <?php foreach($result as $post) : ?>
            <h3><?php echo "*** " . $post['title'] . " ***"; ?></h3>
            <h4><?php echo "By: " . $post['username']; ?></h4>
            <p><?php echo $post['content']; ?></p>
            <h4><?php echo "Created @ " . $post['created_at'] ?></h4>
            <h4>*****</h4><br>
        <?php endforeach ?>
        
        <?php if ($result->num_rows == 0) : ?>
            <h3>No blog posts found.</h3>
        <?php endif ?>
        
        <a href="logout.php">Logout</a>
    </body>
</html> 