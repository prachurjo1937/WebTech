<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: ../view/login.php");
    exit();
}

require "../model/User.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $contact = htmlspecialchars(trim($_POST['contact']));


    $stmt = $conn->prepare("UPDATE users SET name = ?, contact = ? WHERE email = ?");
    $stmt->bind_param("sss", $name, $contact, $_SESSION['email']);
    if ($stmt->execute()) {
        $_SESSION['name'] = $name;  
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile.";
    }
}

$stmt = $conn->prepare("SELECT name, contact FROM users WHERE email = ?");
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>
<body>
    <h2>Update Profile</h2>
    <form method="post" action="">
        <label for="name">Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>

        <label for="contact">Contact:</label><br>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required><br><br>

        <input type="submit" value="Update Profile">
    </form>
    <br>
    <a href="../view/dashboard.php">Back to Dashboard</a>
</body>
</html>
