<?php
require __DIR__ . "/../config/db.php";
date_default_timezone_set("Asia/Riyadh");


$input = trim($_GET['val'] ?? '');

{
if (!isset($_GET['val']) || trim($_GET['val']) === "") {
    header("Location: error.php"); 
    exit();
}}

$today = date("Y-m-d");
$now   = new DateTime("now");


$sql = "
    SELECT *
    FROM appointments
    WHERE appointment_number = ?
       OR national_id = ?
       OR iqama_number = ?
    LIMIT 1
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $input, $input, $input);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: not_found.php");
    exit();
}


$row = $result->fetch_assoc();
$app_number = $row['appointment_number'];
$app_time = new DateTime($row['appointment_time']);
$app_date = $app_time->format("Y-m-d");


$clinic = isset($row['clinic_name']) && $row['clinic_name'] !== ""
    ? $row['clinic_name']
    : "العيادة العامة";


if ($app_date !== $today) {
    header("Location: not_today.php");
    exit();
}


$sql2 = "
    SELECT *
    FROM patients
    WHERE appointment_number = ?
      AND DATE(attendance_time) = CURDATE()
    LIMIT 1
";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $app_number);
$stmt2->execute();
$already = $stmt2->get_result();

if ($already->num_rows > 0) {
    header("Location: already_checked.php");
    exit();
}


$now = new DateTime("now");
$app_time = new DateTime($row['appointment_time']);
$diff_minutes = ($now->getTimestamp() - $app_time->getTimestamp()) / 60;


if ($diff_minutes < -30) {
    header("Location: too_early.php");
    exit();
}


if ($diff_minutes > 10) {
    header("Location: too_late.php");
    exit();
}


$sql3 = "
    SELECT queue_number
    FROM patients
    WHERE DATE(attendance_time) = CURDATE()
    ORDER BY patient_id DESC
    LIMIT 1
";
$last = $conn->query($sql3);

$new_queue = ($last && $last->num_rows > 0)
    ? ((int)$last->fetch_assoc()['queue_number'] + 1)
    : 1;


$sql4 = "
    INSERT INTO patients (appointment_number, attendance_time, queue_number, status, clinic_name)
    VALUES (?, NOW(), ?, 'Attended', ?)
";
$stmt4 = $conn->prepare($sql4);
$stmt4->bind_param("sis", $app_number, $new_queue, $clinic);
$stmt4->execute();

header("Location: success.php?queue=$new_queue&time=" . urlencode($now->format("H:i")) . "&clinic=" . urlencode($clinic));
exit();





?>
