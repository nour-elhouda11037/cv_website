<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require 'database.php';

if (!isset($_SESSION['id_user'])) 
{
    header("Location: login.php");
    exit;
}
$id_user = $_SESSION['id_user'];
$cv_id = $_GET['id'];
$stmt = $conn->prepare("SELECT id FROM resumes WHERE id = ? AND id_user = ?");
$stmt->bind_param("ii", $cv_id, $id_user);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) 
{
    echo "Resume not found or access denied.";
    exit;
}
$conn->query("DELETE FROM education WHERE id_resume = $cv_id"  );
$conn->query("DELETE FROM experience WHERE id_resume = $cv_id");
$conn->query("DELETE FROM skills WHERE id_resume = $cv_id");
$conn->query("DELETE FROM resumes WHERE id = $cv_id");
header("Location: dashboard.php");
exit;
?>