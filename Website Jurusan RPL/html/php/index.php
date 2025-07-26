<?php
require_once 'config/database.php';
require_once 'models/UserModel.php';
require_once 'models/SkillModel.php';
require_once 'models/ProjectModel.php';

$userModel = new UserModel($conn);
$skillModel = new SkillModel($conn);
$projectModel = new ProjectModel($conn);

$profile = $userModel->getProfile();
$skills = $skillModel->getSkills();
$projects = $projectModel->getProjects();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Portofolio</title>
</head>
<body>
    <h1><?= htmlspecialchars($profile['nama_lengkap']) ?></h1>
    <p><?= htmlspecialchars($profile['deskripsi_singkat']) ?></p>

    <h2>Skill</h2>
    <ul>
        <?php foreach ($skills as $skill): ?>
            <li><?= htmlspecialchars($skill['nama_keahlian']) ?> (<?= $skill['tingkat_keahlian'] ?>/5)</li>
        <?php endforeach; ?>
    </ul>

    <h2>Project</h2>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <strong><?= htmlspecialchars($project['judul']) ?></strong><br>
                <?= htmlspecialchars($project['deskripsi']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
