<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photo_uploads";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password

    // Check if username already exists
    $check = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($check);
    
    if ($result->num_rows > 0) {
        echo "Username already exists.";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
