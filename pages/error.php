<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حدث خطأ</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="topbar">
    <span class="logo-text">نظام الحضور الذاتي</span>
</div>

<div class="page-wrapper">
    <div class="state-card">

        <div class="icon-circle danger">!</div>

        <div class="state-title">حدث خطأ غير متوقع</div>
        <div class="state-text">
            نعتذر، حدث خطأ غير متوقع أثناء معالجة الطلب.<br>
            الرجاء المحاولة مرة أخرى، أو مراجعة قسم تقنية المعلومات.
        </div>

      

        <div style="margin-top: 10px; font-size: 14px; color:#777;">
            سيتم الرجوع تلقائيًا إلى صفحة التحقق خلال 5 ثوانٍ…
        </div>
    </div>

    <footer>نظام تسجيل الحضور الذاتي – مشروع تدريبي</footer>
</div>

<script>
    setTimeout(function () {
        window.location.href = "check.php";
    }, 5000);
</script>

</body>
</html>
