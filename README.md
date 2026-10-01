# Self Check-in System | نظام تسجيل الحضور الذاتي

An Arabic (RTL) web application that lets patients check in for their appointments on a kiosk screen, receive a queue number, and lets admins monitor attendance on a live dashboard.

نظام ويب عربي يتيح للمريض تسجيل حضوره لموعده ذاتيًا عبر شاشة، والحصول على رقم انتظار، مع لوحة تحكم للمشرف لمتابعة الحضور.

>  Training project. Uses demo data only, no real patient information.
> مشروع تدريبي، يستخدم بيانات تجريبية فقط.

## Features | المميزات
- Check-in using national ID, iqama number, or appointment number
- Input validation (10 digits for ID/iqama, 15 characters for appointment number)
- Time-window rules: up to 30 minutes early and up to 10 minutes late
- Automatic queue number per day
- Clear status screens with auto-redirect: success, already checked in, not today, too early, too late, not found, error
- Admin login and dashboard: today appointments, attendance count, attendance rate, latest check-ins

## Tech Stack | التقنيات
PHP (MySQLi, prepared statements) · MySQL · HTML / CSS / JavaScript · Tajawal font

## Project Structure | هيكل المشروع
```
├── index.php          # redirects to the check-in page
├── config/            # database connection (db.example.php)
├── assets/            # css and images
├── pages/             # patient-facing pages
├── admin/             # admin login and dashboard
└── database/          # schema.sql
```

## Setup | التشغيل
1. Install XAMPP (or any PHP + MySQL server) and place the folder in htdocs
2. Import database/schema.sql from phpMyAdmin
3. Copy config/db.example.php to config/db.php and set your database user and password
4. Add a few demo rows to the appointments table
5. Open http://localhost/self-checkin-system/

## Create an admin user | إنشاء حساب مشرف
Generate a password hash:

`php -r "echo password_hash('YourPassword', PASSWORD_DEFAULT);"`

Then insert it:

`INSERT INTO admin (username, password) VALUES ('admin', 'PASTE_HASH_HERE');`

Admin login page: /admin/login.php

## Known Limitations & Ideas | ملاحظات وأفكار للتطوير
- The SMS message shown on the success page is a UI placeholder (no SMS gateway is connected)
- The QR image is a static placeholder
- Possible improvements: real SMS integration, CSRF protection, login attempt limits, transaction-safe queue numbering, multi-clinic queues