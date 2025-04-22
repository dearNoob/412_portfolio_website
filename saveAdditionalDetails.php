<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $certifications = $_POST['certifications'];
    $languages = $_POST['languages'];
    $hobbies = $_POST['hobbies'];
    $otherDetails = $_POST['otherDetails'];

    $sql = "INSERT INTO additional_details (certifications, languages, hobbies, other_details)
            VALUES (:certifications, :languages, :hobbies, :other_details)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':certifications' => $certifications,
        ':languages' => $languages,
        ':hobbies' => $hobbies,
        ':other_details' => $otherDetails
    ]);

    header('Location: pdf.html');
    exit();
}
?>