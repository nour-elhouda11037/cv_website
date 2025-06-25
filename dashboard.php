<?php
session_start();
require 'database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
$id_user = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM resumes WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$resumes = $result->fetch_all(MYSQLI_ASSOC);
?>

<html>
    <head>
        <title>Your CVs</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="dashboard">
            <h2>Welcome back!<?= htmlspecialchars($_SESSION['username'])?></h2>
            <?php if (empty($resumes)): ?>
                <p class="no-saves">No saves yet.</p>
            <?php else: ?>
            <ul class="cv-list">
            <?php foreach ($resumes as $cv): ?>
                <li>
                    <strong><?= htmlspecialchars($cv['title']) ?></strong> <br>
                    <small>Created on <?= $cv['created_at'] ?></small><br>
                    <a href="form.php?id=<?= $cv['id'] ?>">Edit</a>
                    <a href="show.php?id=<?= $cv['id'] ?>">Show</a>
                    <a href="export.php?id=<?= $cv['id'] ?>">Export</a>
                    <a href="delete.php?id=<?= $cv['id'] ?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        <br>
        <a href="form.php" class="btn">Create a New CV</a>
        <a href="logout.php" class="btn secondary">Logout</a>
        </div>
    </body>
</html>