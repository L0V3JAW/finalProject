<?php
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

        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Username already exists!";
        } else {
            $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_password')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campers Unite! | Register</title>
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
    <h1>Welcome to Campers Unite!</h1>
    <h3>A friendly blog where campers can kick it.</h3>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>