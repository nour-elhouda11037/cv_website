<?php
session_start();
require 'database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
$id_user = $_SESSION['id_user'];
$resume = null;
$editing = false;
if (isset($_GET['id'])) {
    $cv_id = (int) $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM resumes WHERE id = ? AND id_user = ?");
    $stmt->bind_param("ii", $cv_id, $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $resume = $result->fetch_assoc();
        $editing = true;
    } 
    else {
        echo "Invalid Resume, Please Try Again.";
        exit;
    }
}
?>

<html>
    <head>
        <title>CV Form</title>
        <link rel="stylesheet" href="style.css">
        <script>
                function addEducation() {
                    const block = document.querySelector('.edu-block').cloneNode(true);
                    block.querySelectorAll('input, textarea').forEach(el => el.value = '');
                    document.getElementById('education-section').appendChild(block);
                }
                function addExperience() {
                    const block = document.querySelector('.exp-block').cloneNode(true);
                    block.querySelectorAll('input, textarea').forEach(el => el.value = '');
                    document.getElementById('experience-section').appendChild(block);
                }
                function addSkill() {
                    const block = document.querySelector('.skill-block').cloneNode(true);
                    block.querySelectorAll('input').forEach(el => el.value = '');
                    document.getElementById('skills-section').appendChild(block);
                }
                function confirmSave() {
                    return confirm("Are you sure you want to save?");
                }
        </script>
    </head>
    <body>
        <form method="post" action="save_form.php" onsubmit="return confirmSave();"  >
            <h2>CV Title</h2>
            <input type="text" name="title" placeholder="e.g. Web Developer CV" value="<?= htmlspecialchars($resume['title'] ?? '') ?>" required>
            <h2>Education</h2>
            <div id="education-section">
                <div class="edu-block">
                    <input name="school_name[]" placeholder="School Name" required>
                    <input name="degree[]" placeholder="Degree" required>
                    <input name="edu_start[]" type="date" required>
                    <input name="edu_end[]" type="date" required>
                    <textarea name="edu_desc[]" placeholder="Description"></textarea>
                </div>
            </div>
            <button type="button" onclick="addEducation()">+ Add More</button>
            <h2>Experience</h2>
            <div id="experience-section">
                <div class="exp-block">
                    <input name="company_name[]" placeholder="Company Name" required>
                    <input name="position[]" placeholder="Position" required>
                    <input name="exp_start[]" type="date" required>
                    <input name="exp_end[]" type="date" required>
                    <textarea name="exp_desc[]" placeholder="Description"></textarea>
                </div>
            </div>
            <button type="button" onclick="addExperience()">+ Add More</button>
            <h2>Skills</h2>
            <div id="skills-section">
                <div class="skill-block">
                    <input name="skill[]" placeholder="Skill" required>
                    <select name="level[]">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
            </div>
            <button type="button" onclick="addSkill()">+ Add More</button>
            <br><br>
            <button type="submit">Save CV</button>
        </form>
    </body>
</html>