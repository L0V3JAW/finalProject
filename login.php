<?php
    session_start();

    $host = "localhost";
    $username = "root"; 
    $password = "sesame";
    $database = "campers_unite";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM users WHERE username='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($pass, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: welcome.php");
                exit;
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with that username!";
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <h2>Login</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>