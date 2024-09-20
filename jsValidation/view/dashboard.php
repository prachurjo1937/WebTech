<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard, <?php echo $_SESSION['name']; ?>!</h1>
    <p><a href="../controller/profileUpdate.php">Change Profile</a></p>
    <p><a href="../controller/changePassword.php">Update Password</a></p>
    <p><a href="../controller/logout.php">Logout</a></p>
</body>
</html>
