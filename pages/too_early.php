<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>حضرت مبكرًا</title>
<link rel="stylesheet" href="../assets/css/style.css">

<script>
let s = 10;
function timer(){
    let t = document.getElementById("num");
    let h = setInterval(()=>{
        s--; t.textContent=s;
        if(s<=0){ clearInterval(h); window.location.href="check.php"; }
    },1000);
}
window.onload=timer;
</script>

</head>
<body>

<div class="topbar">
    <span class="logo-text">نظام الحضور الذاتي</span>
</div>

<div class="page-wrapper">
<div class="state-card">

    <div class="icon-circle warning">⏳</div>

    <div class="state-title">حضرت مبكرًا</div>
    <div class="state-text">
        الوقت الحالي مبكر عن موعدك.<br>
        الرجاء الحضور قبل الموعد بـ 30 دقيقة فقط.
    </div>

    <div style="color:#0A75AD;font-size:18px;">
        الرجوع تلقائيًا خلال <span id="num" style="font-weight:bold;">10</span> ثوانٍ
    </div>

</div>

<footer>نظام تسجيل الحضور الذاتي – مشروع تدريبي</footer>
</div>

</body>
</html>
