<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="../controller/loginAction.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" name="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>

        <?php
        if (!empty($_SESSION['login_err'])) {
            echo "<p style='color:red;'>" . $_SESSION['login_err'] . "</p>";
            unset($_SESSION['login_err']); 
        }
        ?>

        <p>Don't have an account? <a href="../view/registration.php">Register here</a></p>
    </div>
</body>
</html>
