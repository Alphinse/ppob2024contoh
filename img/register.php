<?php
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($conn, $username, $email, $password)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Username or email already exists.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form id="registerForm" method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
