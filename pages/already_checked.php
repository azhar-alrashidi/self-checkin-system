<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>تم تسجيل حضورك مسبقًا</title>
<link rel="stylesheet" href="../assets/css/style.css">

<script>
let seconds = 10;
function countdown() {
    let n = document.getElementById("countdown");
    let timer = setInterval(() => {
        seconds--;
        n.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
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

<div class="page-wrapper">

<div class="state-card">

    <div class="icon-circle success">✔</div>

    <div class="state-title">تم تسجيل حضورك مسبقًا</div>
    <div class="state-text">
        لقد تم تسجيل حضورك لهذا الموعد سابقًا.<br>
        الرجاء التوجه إلى شاشة الانتظار.
    </div>

    <div style="color:#0A75AD; font-size:18px; margin-top:10px;">
        سيتم الرجوع تلقائيًا خلال <span id="countdown" style="font-weight:bold;">8</span> ثوانٍ
    </div>

</div>

<footer>نظام تسجيل الحضور الذاتي – مشروع تدريبي</footer>

</div>

</body>
</html>
