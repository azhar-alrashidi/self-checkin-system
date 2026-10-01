<?php
date_default_timezone_set("Asia/Riyadh");

$queue  = $_GET['queue'] ?? 0;
$time   = $_GET['time'] ?? date("H:i");
$date   = date("Y-m-d");
$clinic = $_GET['clinic'] ?? "العيادة العامة";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تم تأكيد حضورك</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
       
.success-wrapper {
    min-height: calc(100vh - 85px);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
}

.success-card {
    width: 100%;
    max-width: 900px;
    background: #fff;
    border-radius: 20px;
    padding: 30px 35px;
    box-shadow: 0 14px 40px rgba(0,0,0,0.12);
    text-align: center;
}


.success-number-frame {
    border: 2px dashed #c3d7e6;
    border-radius: 16px;
    width: 200px;
    padding: 15px;
    margin: 12px auto;
}

.success-number-frame span {
    font-size: 52px;
    font-weight: 700;
    color: #0A75AD;
}


.success-details-row {
    display: flex;
    justify-content: center;
    gap: 25px;
    font-size: 15px;
    color: #555;
    margin-bottom: 10px;
}

.success-qr img {
    width: 95px;       
    height: 95px;
    margin: 8px 0;
}


.success-msg-box {
    background: #e7f5e8;
    color: #2e7d32;
    padding: 8px 12px;
    border-radius: 10px;
    font-size: 14px;
    max-width: 500px;
    margin: 8px auto;
}


.countdown-text {
    margin-top: 6px;
    font-size: 14px;
    color: #0A75AD;
    font-weight: 500;
}


@media (max-width: 768px) {
    .success-details-row {
        flex-direction: column;
        gap: 6px;
    }
}

    </style>

    <script>
        let seconds = 10;
        function countdown() {
            const n = document.getElementById("countdown-number");
            const t = setInterval(() => {
                seconds--;
                n.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(t);
                    window.location.href = "check.php";
                }
            }, 1000);
        }
        window.onload = countdown;
    </script>
</head>

<body>

<div class="topbar">
    <span class="logo-text">نظام الحضور الذاتي</span>
</div>

<div class="success-wrapper">

    <div class="success-card">

        <div class="icon-circle success">✔</div>

        <div class="state-title">تم تأكيد حضورك</div>
        <div class="state-text">تم تسجيل حضورك بنجاح لموعدك.</div>

        <div class="success-number-frame">
            <span><?= htmlspecialchars($queue) ?></span>
        </div>

        <div class="success-details-row">
            <div>🏥 <?= htmlspecialchars($clinic) ?></div>
            <div>⏰ <?= htmlspecialchars($time) ?></div>
            <div>📅 <?= $date ?></div>
        </div>

        <div class="success-qr">
            <img src="../assets/img/barcode_dummy.png" alt="QR Code">
        </div>

        <div class="success-msg-box">
            تم إرسال رسالة نصية إلى جوالك تحتوي على رقم الانتظار:
            <strong><?= htmlspecialchars($queue) ?></strong>
        </div>

        <div class="countdown-text">
            سيتم الرجوع تلقائيًا خلال <span id="countdown-number">5</span> ثوانٍ
        </div>

    </div>

</div>

</body>
</html>
