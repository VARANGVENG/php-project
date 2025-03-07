
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>

    <div class="form-container">
        <h2>Create an Account</h2>
        <form action="register.php" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                <?php if(isset($username_err)) echo "<div class='error'>$username_err</div>"; ?>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <?php if(isset($email_err)) echo "<div class='error'>$email_err</div>"; ?>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <?php if(isset($password_err)) echo "<div class='error'>$password_err</div>"; ?>
            </div>

            <div>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <?php if(isset($confirm_password_err)) echo "<div class='error'>$confirm_password_err</div>"; ?>
            </div>

            <input type="submit" value="Register">
        </form>
        
        <div class="form-footer">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

</body>
</html>
