<?php
$host = "localhost";
$user = "your_db_user";
$password = "your_db_password";
$database = "hospital_system";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
