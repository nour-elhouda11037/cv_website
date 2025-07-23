

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
