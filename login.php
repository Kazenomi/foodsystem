<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        // Verify the password
        if ($password === $user['password']) {  // Compare plain text password
            // Password is correct
            $welcomeMessage = "Welcome, " . $user['name'] . " to FoodEngine!";
            session_start();
            $_SESSION['id'] = $user['ID'];
            echo '<script>alert("' . $welcomeMessage . '"); window.location.href="home.html";</script>';
            exit();
        } else {
            // Wrong password
            $errorMessage = '<span style="color: red;">Wrong password !</span>';
        }
    } else {
        // User does not exist
        $errorMessage = '<span style="color: red;">Wrong email !</span>';
    }
    
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="./image/icon.png" type="image/icon type">
</head>
<body>
    <div class="container">
        <div class="loginbg">
            <div class="box signin">
                <h2>Already Have an Account ?</h2>
                <button class="signinbtn">Sign in</button>
            </div>
            <div class="box signup">
                <h2>Don't Have an Account ?</h2>
                <button class="signupbtn">Sign up</button>
            </div>
        </div>
        <div class="formbx">
            <div class="form signinform">
                <form action="login.php" method="POST" id="loginForm">
                    <h2>FoodEngine</h2>
                    <h3>Sign In</h3>
                    <?php if (isset($errorMessage)) { ?>
                        <p class="error"><?php echo $errorMessage; ?></p>
                    <?php } ?>
                    <input type="email" placeholder="Email" required="" autofocus="" name="email">
                    <input type="password" placeholder="Password" required="" name="password">
                    <input type="submit" value="Login">
                    <a href="#" class="forgot">Forgot password?</a>
                </form>
            </div>
            <div class="form signupform">
                <form action="register.php" method="POST" id="registerForm">
                    <h3>Sign up</h3>
                    <input type="text" placeholder="Enter Your Name" name="name" required="" autofocus="">
                    <input type="email" placeholder="Email" name="email" required="" >
                    <input type="text" placeholder="Contact" name="contact" required="" >
                    <input type="text" placeholder="Address" name="address" required="" >
                    <input type="password" placeholder="Password" name="password" required="" >
                    <input type="submit" value="Sign Up">
                </form>
            </div>
        </div>
    </div>

    <script>
        const signinbtn = document.querySelector('.signinbtn');
        const signupbtn = document.querySelector('.signupbtn');
        const formbx = document.querySelector('.formbx');
        const body = document.querySelector('body');

        // Check if redirected from registration
        const urlParams = new URLSearchParams(window.location.search);
        const registered = urlParams.get('registered');

        // Toggle forms accordingly
        if (registered) {
            formbx.classList.add('active');
            body.classList.add('active');
        }

        signupbtn.onclick = function() {
            formbx.classList.add('active');
            body.classList.add('active');
        };

        signinbtn.onclick = function() {
            formbx.classList.remove('active');
            body.classList.remove('active');
        };
    </script>
</body>
</html>
