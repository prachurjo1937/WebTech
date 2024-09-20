<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <script type="text/javascript" src="external.js"></script>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form method="post" action="../controller/registrationCheck.php" onsubmit="return validateRegistrationForm(this);" novalidate>
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo empty($_SESSION['name']) ? "" : $_SESSION['name'] ?>">
            <span><?php echo empty($_SESSION['name_err']) ? "" : $_SESSION['name_err'] ?></span>
            <br><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo empty($_SESSION['email']) ? "" : $_SESSION['email'] ?>">
            <span><?php echo empty($_SESSION['email_err']) ? "" : $_SESSION['email_err'] ?></span>
            <br><br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo empty($_SESSION['password']) ? "" : $_SESSION['password'] ?>">
            <span><?php echo empty($_SESSION['password_err']) ? "" : $_SESSION['password_err'] ?></span>
            <br><br>

            <label for="con_password">Confirm Password</label>
            <input type="password" id="con_password" name="con_password" value="<?php echo empty($_SESSION['con_password']) ? "" : $_SESSION['con_password'] ?>">
            <span><?php echo empty($_SESSION['con_password_err']) ? "" : $_SESSION['con_password_err'] ?></span>
            <br><br>

            <label for="gender">Gender</label>
            <input type="radio" id="male" name="gender" value="male" <?php echo (isset($_SESSION['gender']) && $_SESSION['gender'] == 'male') ? 'checked' : '' ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" <?php echo (isset($_SESSION['gender']) && $_SESSION['gender'] == 'female') ? 'checked' : '' ?>>
            <label for="female">Female</label>
            <span><?php echo empty($_SESSION['gender_err']) ? "" : $_SESSION['gender_err'] ?></span>
            <br><br>

            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" value="<?php echo empty($_SESSION['contact']) ? "" : $_SESSION['contact'] ?>">
            <span><?php echo empty($_SESSION['contact_err']) ? "" : $_SESSION['contact_err'] ?></span>
            <br><br>

            <input type="submit" value="Register">
        </form>

        <?php echo empty($_SESSION['err']) ? "" : $_SESSION['err'] ?>
        <p>Already have an account? <a href="../view/login.php">Login here</a></p>
    </div>
</body>
</html>
