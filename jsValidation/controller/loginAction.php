<?php
session_start();

require "../models/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            
            echo "Login successful, redirecting..."; 
            
            header("Location: ../view/dashboard.php");
            exit();
        } else {
            $_SESSION['login_err'] = "Invalid password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_err'] = "No user found with this email.";
        header("Location: ../view/login.php");
        exit();
    }
}


$conn->close();
?>
