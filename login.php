<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = trim($_POST['usernameOrEmail']);
    $password = $_POST['pswrd'];
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashed);
        $stmt->fetch();
        if (password_verify($password, $hashed)) {
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $id;
            header("Location: dashboard.php");
            exit;}
        else {
            echo "Wrong password, please try again";}
    } 
    else {
        echo "Account isn't found";}
    $stmt->close();
    $conn->close();}
?>
<html>
    <head>
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div>
            <h2>Welcome back!</h2>
            <form method="post">
                <label>Username Or E-mail<input name="usernameOrEmail" required></label><br>
                <label>Password <input name="pswrd" type="password" required></label><br>
                <button type="submit">Log in</button>
                <p>No account? <a href="signup.php">Sign up here!</a></p>
            </form>
        </div>
    </body>
</html>