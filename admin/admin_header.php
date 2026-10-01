<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<div style="
    background: #0A75AD;
    padding: 20px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
">
    
    <span class="logo-text">نظام الحضور الذاتي</span>

    <h2 style="margin: 0;">لوحه البيانات اللحظيه</h2>


    <a href="logout.php" style="
        background: #fff;
        padding: 8px 18px;
        border-radius: 10px;
        color: #0A75AD;
        text-decoration: none;
        font-weight: bold;
    ">تسجيل خروج</a>
</div>
