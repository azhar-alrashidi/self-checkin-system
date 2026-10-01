<?php
session_start();
require __DIR__ . "/../config/db.php"; 

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($username === "" || $password === "") {
        $error_msg = "الرجاء إدخال اسم المستخدم وكلمة المرور.";
    } else {

        $stmt = $conn->prepare(
            "SELECT admin_id, password FROM admin WHERE username = ? LIMIT 1"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();

          
            if (password_verify($password, $admin["password"])) {
                session_regenerate_id(true);
                $_SESSION["admin"] = $admin["admin_id"];
                header("Location: dashboard.php");
                exit();
            } else {
                $error_msg = "بيانات الدخول غير صحيحة.";
            }

        } else {
            $error_msg = "بيانات الدخول غير صحيحة.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول - لوحة التحكم</title>

    <style>
        body {
            margin: 0;
            font-family: "Tajawal", sans-serif;
            background: #eaf3fa;
        }

       
        .topbar {
            background-color: #0A75AD;
            height: 85px;
            display: flex;
            justify-content: flex-end; 
            align-items: center;
            padding: 0 35px;
        }

        .topbar img {
            height: 65px;
        }

        
        .system-title {
            text-align: center;
            font-size: 32px;
            font-weight: 800;
            color: #0A75AD;
            margin-top: 35px;
            margin-bottom: 5px;
        }

    
        .card-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .login-card {
            width: 520px;
            background: #ffffff;
            padding: 45px 40px;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.10);
            text-align: center;
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: #0A75AD;
            margin-bottom: 25px;
        }

        .input-container {
            position: relative;
            margin-bottom: 18px;
        }

        .input-box {
            width: 100%;
            padding: 14px 48px;
            font-size: 18px;
            border-radius: 12px;
            border: 2px solid #0A75AD;
            outline: none;
            transition: 0.25s;
            box-sizing: border-box;
        }

        .input-box:focus {
            box-shadow: 0 0 0 3px rgba(10,117,173,0.25);
        }

        .input-icon {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            font-size: 21px;
            color: #0A75AD;
        }

        .toggle-pass {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 19px;
            cursor: pointer;
            color: #0A75AD;
        }

      
        .inline-error {
            background: #ffecec;
            color: #b63131;
            padding: 10px;
            border-radius: 8px;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .primary-btn {
            background-color: #0A75AD;
            color: #ffffff;
            padding: 12px 0;
            width: 60%;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
            transition: 0.25s;
        }

        .primary-btn:hover {
            background-color: #085b86;
        }

    
        .security-hint {
            margin-top: 18px;
            font-size: 14px;
            color: #666;
        }
    .logo-text{color:#fff;font-size:24px;font-weight:700;}
</style>

    <script>
        function togglePassword() {
            const passField = document.getElementById("password");
            passField.type = passField.type === "password" ? "text" : "password";
        }
    </script>

</head>
<body>


<div class="topbar">
    <span class="logo-text">نظام الحضور الذاتي</span>
</div>

<div class="system-title">إدارة نظام تسجيل الحضور الذاتي</div>

<div class="card-wrapper">
    <div class="login-card">

        <div class="card-title">تسجيل دخول المشرف</div>

        <form method="POST">

            <div class="input-container">
                <span class="input-icon">👤</span>
                <input
                    type="text"
                    name="username"
                    class="input-box"
                    placeholder="أدخل اسم المستخدم"
                >
            </div>

            <div class="input-container">
                <span class="input-icon">🔒</span>
                <span class="toggle-pass" onclick="togglePassword()">👁</span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="input-box"
                    placeholder="أدخل كلمة المرور"
                >
            </div>

            <?php if ($error_msg !== ""): ?>
                <div class="inline-error"><?= htmlspecialchars($error_msg) ?></div>
            <?php endif; ?>

            <button type="submit" class="primary-btn">دخول</button>

            <div class="security-hint">
                🔒 لأسباب أمنية، لا يتم توضيح أي تفاصيل عند فشل تسجيل الدخول.
            </div>

        </form>
    </div>
</div>

</body>
</html>
