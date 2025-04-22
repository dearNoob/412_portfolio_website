<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $surname = $_POST['surname'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO personal_info (first_name, surname, city, postal_code, country, phone, email)
            VALUES (:first_name, :surname, :city, :postal_code, :country, :phone, :email)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':first_name' => $firstName,
        ':surname' => $surname,
        ':city' => $city,
        ':postal_code' => $postalCode,
        ':country' => $country,
        ':phone' => $phone,
        ':email' => $email
    ]);

    header('Location: experience.html');
    exit();
}
?>