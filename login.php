<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashed);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;}
        else {
            echo "Wrong password.";}
    } 
    else {
        echo "User not found.";}
    $stmt->close();
    $conn->close();}
?>