<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $summary = $_POST['summary'];

    $sql = "INSERT INTO summary (summary_text) VALUES (:summary_text)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':summary_text' => $summary
    ]);

    header('Location: additional.html');
    exit();
}
?>