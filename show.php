<?php
session_start();
require 'database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
$cv_id = $_GET['id'];
$id_user = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM resumes WHERE id = ? AND id_user = ?");
$stmt->bind_param("ii", $cv_id, $id_user);
$stmt->execute();
$resume = $stmt->get_result()->fetch_assoc();
$education = $conn->query("SELECT * FROM education WHERE id_resume = $cv_id")->fetch_all(MYSQLI_ASSOC);
$experience = $conn->query("SELECT * FROM experience WHERE id_resume = $cv_id")->fetch_all(MYSQLI_ASSOC);
$skills = $conn->query("SELECT * FROM skills WHERE id_resume = $cv_id")->fetch_all(MYSQLI_ASSOC);
?>

<html>
    <head>
        <title>CV: <?= htmlspecialchars($resume['title']) ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2><?= htmlspecialchars($resume['title']) ?></h2>
        <h3>Education</h3>
        <ul><?php foreach ($education as $edu): ?>
            <li><?= htmlspecialchars($edu['school_name']) ?> (<?= $edu['degree'] ?>)</li>
            <?php endforeach; ?>
        </ul>
        <h3>Experience</h3>
        <ul><?php foreach ($experience as $exp): ?>
            <li><?= htmlspecialchars($exp['company_name']) ?> - <?= htmlspecialchars($exp['position']) ?></li>
            <?php endforeach; ?>
        </ul>
        <h3>Skills</h3>
        <ul><?php foreach ($skills as $skill): ?>
            <li><?= htmlspecialchars($skill['skill']) ?> (<?= htmlspecialchars($skill['level']) ?>)</li>
            <?php endforeach; ?>
        </ul>
        <a href="dashboard.php" class="btn">Back</a>
    </body>
</html>
