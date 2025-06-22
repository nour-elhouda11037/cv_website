<?php
session_start();
require 'database.php';

$errors=[];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pswrd = $_POST['pswrd'];
    $confirm = $_POST['confirm'];
    if ($pswrd !== $confirm) {
        echo "Passwords do not match, please try again";
        exit;
    }
    $hashed = password_hash($pswrd, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $email);    
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Username or email already used!";}
    else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed);
        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Registration failed.";
        }
    }
$stmt->close();
    $conn->close();}
?>

<html>
    <head>
        <title> Sign Up</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div>
            <h2>Create account</h2>
            <?php foreach ($errors as $e) echo "<p style='color:red'>$e</p>"; ?>
            <form method="post">
                <label>Username <input name="username" required></label><br>
                <label>Email    <input name="email" type="email" required></label><br>
                <label>Password <input name="pswrd" type="password" required></label><br>
                <label>Confirm  <input name="confirm"  type="password" required></label><br>
                <button type="submit">Register</button>
                <p>Already registered? <a href="login.php">Log in from here!</a></p>
            </form>
        </div>
    </body>
</html>