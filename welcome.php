<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Campers Unite! | Welcome</title>
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
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <h3>Where do we go from here?</h3>
        <a href="readpost.php">Read some posts!</a> | <a href="createpost.php">Create a post!</a><br><br>
        <a href="logout.php">Logout</a>
    </body>
</html> 


