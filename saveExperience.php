<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobTitle = $_POST['jobTitle'];
    $company = $_POST['company'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sql = "INSERT INTO experience (job_title, company, city, country, start_date, end_date)
            VALUES (:job_title, :company, :city, :country, :start_date, :end_date)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':job_title' => $jobTitle,
        ':company' => $company,
        ':city' => $city,
        ':country' => $country,
        ':start_date' => $startDate,
        ':end_date' => $endDate
    ]);

    header('Location: education.html');
    exit();
}
?>