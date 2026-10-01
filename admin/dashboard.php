<?php
session_start();
require __DIR__ . "/../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");                                                
    exit();
}

$today = date("Y-m-d");

$sql1 = $conn->prepare("SELECT COUNT(*) AS total FROM appointments WHERE DATE(appointment_time) = ?");
$sql1->bind_param("s", $today);
$sql1->execute();
$total_appointments = $sql1->get_result()->fetch_assoc()["total"]; 


$sql2 = $conn->prepare("SELECT COUNT(*) AS attended FROM patients WHERE DATE(attendance_time) = ?");
$sql2->bind_param("s", $today);
$sql2->execute();
$total_attended = $sql2->get_result()->fetch_assoc()["attended"];


$attendance_percentage = $total_appointments > 0
    ? round(($total_attended / $total_appointments) * 100)
    : 0;

$last = $conn->query("
    SELECT appointment_number, attendance_time, queue_number, clinic_name
    FROM patients
    WHERE DATE(attendance_time) = '$today'
    ORDER BY patient_id DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title></title>

<style>
body {
    margin: 0;
    font-family: "Tajawal", sans-serif;
    background: #eaf3fa;
}

.topbar {
    background-color: #0A75AD;
    height: 80px;
    display: flex;
    align-items: center;
    padding: 0 25px;
    box-sizing: border-box;
}


.topbar-logout {
    margin-left: auto;
}

.logout-btn {
    background: white;
    color: #0A75AD;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}


.topbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    color: white;
    font-weight: 600;
}

.topbar-brand img {
    height: 60px;
}


.logout-btn:hover {
    background: #f1f1f1;
}


.dashboard-title {
    text-align: center;
    margin: 25px 0;
    font-size: 30px;
    font-weight: 800;
    color: #0A75AD;
}

/* الكروت */
.cards {
    display: flex;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
}

.card {
    width: 280px;
    background: white;
    padding: 25px;
    text-align: center;
    border-radius: 18px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
}

.card h3 {
    margin-bottom: 10px;
    color: #0A75AD;
}

.number {
    font-size: 40px;
    font-weight: 800;
    color: #085b86;
}

/* الجدول */
table {
    width: 90%;
    margin: 40px auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

table th {
    background: #0A75AD;
    color: white;
}
.logo-text{color:#fff;font-size:24px;font-weight:700;}
</style>
</head>

<body>



<div class="topbar">

   
    <div class="topbar-logout">
        <a href="logout.php" class="logout-btn">تسجيل خروج</a>
    </div>


    <div class="topbar-brand">
        
        <span class="logo-text">نظام الحضور الذاتي</span>
    </div>

</div>



<div class="dashboard-title">لوحه إدارة نظام تسجيل الحضور الذاتي</div>

<div class="cards">
    <div class="card">
        <h3>مواعيد اليوم</h3>
        <div class="number"><?= $total_appointments ?></div>
    </div>

    <div class="card">
        <h3>الحضور</h3>
        <div class="number"><?= $total_attended ?></div>
    </div>

    <div class="card">
        <h3>نسبة الحضور</h3>
        <div class="number"><?= $attendance_percentage ?>%</div>
    </div>
</div>

<table>
<tr>
    <th>رقم الموعد</th>
    <th>وقت الحضور</th>
    <th>رقم الانتظار</th>
    <th>العيادة</th>
</tr>

<?php if ($last->num_rows > 0): ?>
    <?php while ($row = $last->fetch_assoc()): ?>
        <tr>
            <td><?= $row["appointment_number"] ?></td>
            <td><?= date("H:i", strtotime($row["attendance_time"])) ?></td>
            <td><?= $row["queue_number"] ?></td>
            <td><?= $row["clinic_name"] ?></td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="4">لا توجد بيانات حضور حتى الآن.</td></tr>
<?php endif; ?>
</table>

</body>
</html>
