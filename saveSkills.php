<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill = $_POST['skill'];

    $sql = "INSERT INTO skills (skill_name) VALUES (:skill_name)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':skill_name' => $skill
    ]);

    header('Location: skill.html');
    exit();
}
?>