<?php
session_start();
require 'database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
$id_user = $_SESSION['id_user'];
$title = trim($_POST['title']);
$stmt = $conn->prepare("INSERT INTO resumes (id_user, title, created_at) VALUES (?, ?, NOW())");
$stmt->bind_param("is", $id_user, $title);
$stmt->execute();
$resume_id = $stmt->insert_id;
foreach ($_POST['school_name'] as $i => $school) {
    $degree = $_POST['degree'][$i];
    $start = $_POST['edu_start'][$i];
    $end   = $_POST['edu_end'][$i];
    $desc  = $_POST['edu_desc'][$i];

    $stmt = $conn->prepare("INSERT INTO education (id_resume, school_name, degree, start_date, end_date, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $resume_id, $school, $degree, $start, $end, $desc);
    $stmt->execute();
}
foreach ($_POST['skill'] as $i => $skill) {
    $level = $_POST['level'][$i];

    $stmt = $conn->prepare("INSERT INTO skills (id_resume, skill, level) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $resume_id, $skill, $level);
    $stmt->execute();
}
foreach ($_POST['company_name'] as $i => $company) {
    $position = $_POST['position'][$i];
    $start = $_POST['exp_start'][$i];
    $end = $_POST['exp_end'][$i];
    $desc = $_POST['exp_desc'][$i];

    $stmt = $conn->prepare("INSERT INTO experience (id_resume, company_name, position, start_date, end_date, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $resume_id, $company, $position, $start, $end, $desc);
    $stmt->execute();
}
echo "<script>   alert('Successfully Saved!'); window.location.href = 'dashboard.php'; </script>";
?>