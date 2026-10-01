<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>تأخرت عن موعدك</title>
<link rel="stylesheet" href="../assets/css/style.css">

<script>
let sec = 10;
function start() {
    let el = document.getElementById("cd");
    let timer = setInterval(()=>{
        sec--;
        el.textContent = sec;
        if(sec <= 0){
            clearInterval(timer);
            window.location.href="check.php";
        }
    },1000);
}
window.onload=start;
</script>

</head>

<body>

<div class="topbar">
    <span class="logo-text">نظام الحضور الذاتي</span>
</div>

<div class="page-wrapper">
<div class="state-card">

    <div class="icon-circle danger">⏰</div>

    <div class="state-title">تأخرت عن موعدك</div>
    <div class="state-text">
        تجاوزت المدة المسموحة (<strong>10 دقائق</strong>).<br>
        يرجى مراجعة الاستقبال لإعادة جدولة الموعد.
    </div>

    <div style="color:#0A75AD; font-size:18px;">
        الرجوع تلقائيًا خلال <span id="cd" style="font-weight:bold;">10</span> ثوانٍ
    </div>

</div>

<footer>نظام تسجيل الحضور الذاتي – مشروع تدريبي</footer>
</div>

</body>
</html>
