<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        

        <h3>Upload Photos</h3>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="photo" required>
            <input type="submit" value="Upload">
        </form>

        <h3>Your Uploaded Photos</h3>
        <div class="gallery">
            <?php
            $conn = new mysqli("localhost", "root", "", "photo_uploads");

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM photos WHERE user_id='$user_id' ORDER BY upload_time DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<img src='uploads/" . $row['file_name'] . "' alt='Uploaded Photo'>";
                }
            } else {
                echo "<p>No photos uploaded yet.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <form action="logout.php" method="post">
        <button type="submit" id="logoutBtn">Logout</button>
    </form>
</body>
</html>
