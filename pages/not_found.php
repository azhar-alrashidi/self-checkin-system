<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>لا يوجد موعد مسجّل</title>
<link rel="stylesheet" href="../assets/css/style.css">

<script>
let s = 8;
function run() {
    let n = document.getElementById("c");
    let t = setInterval(()=>{
        s--; n.textContent = s;
        if(s <= 0){
            clearInterval(t);
            window.location.href="check.php";
        }
    },1000);
}
window.onload = run;
</script>

</head>
<body>

<div class="topbar">
    <span class="logo-text">نظام الحضور الذاتي</span>
</div>

<div class="page-wrapper">
<div class="state-card">

    <div class="icon-circle danger">✕</div>

    <div class="state-title">لا يوجد موعد مسجّل</div>
    <div class="state-text">
        الرقم المدخل غير موجود في النظام.<br>
        الرجاء التأكد من الرقم والمحاولة من جديد.
    </div>

    <div style="color:#0A75AD; font-size:18px;">
        العودة خلال <span id="c" style="font-weight:bold;">8</span> ثوانٍ
    </div>

</div>

<footer>نظام تسجيل الحضور الذاتي – مشروع تدريبي</footer>
</div>

</body>
</html>
