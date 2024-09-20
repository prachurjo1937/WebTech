<?php
session_start();

require "../model/User.php";

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = sanitize($_POST['name']);
$email = sanitize($_POST['email']);
$password = sanitize($_POST['password']);
$con_password = sanitize($_POST['con_password']);
$contact = sanitize($_POST['contact']);
$gender = sanitize($_POST['gender']);
$isValid = true;

$_SESSION['name_err'] = "";
$_SESSION['name'] = "";
$_SESSION['email_err'] = "";
$_SESSION['email'] = "";
$_SESSION['password_err'] = "";
$_SESSION['password'] = "";
$_SESSION['con_password_err'] = "";
$_SESSION['con_password'] = "";
$_SESSION['contact_err'] = "";
$_SESSION['contact'] = "";
$_SESSION['gender_err'] = "";
$_SESSION['gender'] = "";
$_SESSION['err'] = "";
$_SESSION['isLoggedIn'] = false;

if (empty($name)) {
    $_SESSION['name_err'] = "*Please fill up the name properly";
    $isValid = false;
} else {
    $_SESSION['name'] = $name;
}

if (empty($email)) {
    $_SESSION['email_err'] = "*Please fill up the email properly";
    $isValid = false;
} else {
    $_SESSION['email'] = $email;
}

if (empty($password)) {
    $_SESSION['password_err'] = "*Please fill up the password properly";
    $isValid = false;
} else {
    $_SESSION['password'] = $password;
}

if ($password !== $con_password) {
    $_SESSION['con_password_err'] = "*Passwords do not match";
    $isValid = false;
} else {
    $_SESSION['con_password'] = $con_password;
}

if (empty($contact) || !preg_match("/^\d{13}$/", $contact)) {
    $_SESSION['contact_err'] = "*Please enter a valid 13-digit phone number";
    $isValid = false;
} else {
    $_SESSION['contact'] = $contact;
}

if ($gender == "male" || $gender == "female") {
    $_SESSION['gender'] = $gender;
} else {
    $_SESSION['gender_err'] = "*Please select a valid gender";
    $isValid = false;
}

if ($isValid === true) {
    $check = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check);
    
    if ($result->num_rows > 0) {
        $_SESSION['email_err'] = "Email already exists.";
        header("Location: ../view/registration.php");
    } else {
        $sql = "INSERT INTO users (name, email, password, contact, gender) VALUES ('$name', '$email', '$password', '$contact', '$gender')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    header("Location: ../view/registration.php");
}

$conn->close();
?>
