<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>موعدك ليس اليوم</title>
<link rel="stylesheet" href="../assets/css/style.css">

<script>
let seconds = 9;
function countdown(){
    let x = document.getElementById("count");
    let t = setInterval(()=>{
        seconds--;
        x.textContent = seconds;
        if(seconds <= 0){
            clearInterval(t);
            window.location.href="check.php";
        }
    },1000);
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

    <div class="icon-circle warning">📅</div>

    <div class="state-title">موعدك ليس اليوم</div>
    <div class="state-text">
        الموعد المرتبط بهذا الرقم لا يخص هذا اليوم.<br>
        الرجاء الحضور في التاريخ الصحيح.
    </div>

    <div style="color:#0A75AD; font-size:18px;">
        الرجوع تلقائيًا خلال <span id="count" style="font-weight:bold;">9</span> ثوانٍ
    </div>

</div>

<footer>نظام تسجيل الحضور الذاتي – مشروع تدريبي</footer>
</div>

</body>
</html>
