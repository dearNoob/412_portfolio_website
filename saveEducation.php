<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $instituteName = $_POST['instituteName'];
    $schoolLocation = $_POST['schoolLocation'];
    $degree = $_POST['degree'];
    $fieldOfStudy = $_POST['fieldOfStudy'];
    $graduationDate = $_POST['graduationDate'];
    $stillEnrolled = isset($_POST['stillEnrolled']) ? 1 : 0;
    $year = $_POST['year'];

    $sql = "INSERT INTO education (institute_name, school_location, degree, field_of_study, graduation_date, still_enrolled, year)
            VALUES (:institute_name, :school_location, :degree, :field_of_study, :graduation_date, :still_enrolled, :year)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':institute_name' => $instituteName,
        ':school_location' => $schoolLocation,
        ':degree' => $degree,
        ':field_of_study' => $fieldOfStudy,
        ':graduation_date' => $graduationDate,
        ':still_enrolled' => $stillEnrolled,
        ':year' => $year
    ]);

    header('Location: skill.html');
    exit();
}
?>