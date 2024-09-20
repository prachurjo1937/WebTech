<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$targetDir = "uploads/";
$uploadOk = 1;

if (isset($_FILES["photo"])) {
    $fileName = basename($_FILES["photo"]["name"]);
    $targetFile = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allow only certain file types
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            $conn = new mysqli("localhost", "root", "", "photo_uploads");
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO photos (user_id, file_name) VALUES ('$user_id', '$fileName')";

            if ($conn->query($sql) === TRUE) {
                echo "Photo uploaded successfully!";
            } else {
                echo "Error saving to database.";
            }

            $conn->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, & GIF files are allowed.";
    }
}
?>
