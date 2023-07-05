<?php
require_once 'connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$password = $_POST['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    $stmt = $conn->prepare("INSERT INTO customer (name, email, contact, address, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $contact, $address, $password);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Set the success message
    $successMessage = "Registration successful";

    // Redirect to login.html after a delay
    header("refresh:3;url=login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Display the success message as a pop-up -->
    <?php if (isset($successMessage)) { ?>
        <script>
            alert("<?php echo $successMessage; ?>");
        </script>
    <?php } ?>

    <div class="container">
        <h1>Registration Page</h1>
        <form action="register.php" method="POST">
            <!-- Your registration form fields -->
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="contact" placeholder="Contact" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
