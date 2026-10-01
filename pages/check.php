<?php
$error_msg = "";
$input_value = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $input_value = trim($_POST['user_input'] ?? '');

    if ($input_value === "") {
        $error_msg = "الرجاء إدخال رقم الهوية / الإقامة أو رقم الموعد.";
    } else {
        if (preg_match('/^[0-9]+$/', $input_value)) {
            if (strlen($input_value) != 10) {
                $error_msg = "الرجاء إدخال رقم هوية أو إقامة صحيح (10 أرقام).";
            }
        } else {

    if (!preg_match('/^[A-Za-z0-9]{15}$/', $input_value)) {
        $error_msg = "الرجاء إدخال رقم موعد صحيح مكون من 15 خانة.";
    }
}
    }

    if ($error_msg === "") {
        header("Location: check_process.php?val=" . urlencode($input_value));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
       <title>نظام تسجيل حضور المواعيد الذاتي</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="topbar">
    <span class="logo-text">نظام الحضور الذاتي</span>
</div>

<div class="page-wrapper">

    <div class="welcome-card">
 <img src="../assets/img/calendar_icon.png" class="start-icon" alt="calendar" style="width:110px; margin-bottom:20px;">

        <div class="page-title">نظام تسجيل حضور المواعيد الذاتي</div>

        <div class="page-subtitle">
            يرجى إدخال رقم الهوية / الإقامة أو رقم الموعد للتحقق من حضورك.
        </div>

        <form method="POST" class="check-form">

            <input
                type="text"
                name="user_input"
                class="input-box"
                placeholder="أدخل الرقم هنا"
                value="<?php echo htmlspecialchars($input_value); ?>"
                autocomplete="off"
            >

            <?php if ($error_msg !== ""): ?>
                <div class="inline-error">
                    <?php echo htmlspecialchars($error_msg); ?>
                </div>
            <?php endif; ?>

            <div class="button-row">
                <button type="submit" class="primary-btn">تحقّق</button>
                <button type="button"
                        class="secondary-btn"
                        onclick="document.querySelector('input[name=user_input]').value='';">
                    مسح
                </button>
            </div>

        </form>

    </div>

    <footer>نظام تسجيل الحضور الذاتي – مشروع تدريبي</footer>

</div>

</body>
</html>
