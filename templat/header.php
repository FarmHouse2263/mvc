<html>

<head>
<link rel="stylesheet" href="css\all.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        header {
            background: linear-gradient(90deg, #3498db, #1d6fa5);
            color: white;
            width: 100%;
            padding: 15px;
            text-align: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .nav-links {
            margin-top: 10px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .login-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 320px;
            animation: fadeIn 0.8s ease-in-out;
            margin-top: 100px;
            /* Add margin to push down the login container */
        }

        h2 {
            margin-bottom: 15px;
            color: #2c3e50;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .btn {
            background: linear-gradient(90deg, #3498db, #1d6fa5);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(90deg, #1d6fa5, #3498db);
            transform: scale(1.05);
        }

        .register-link {
            margin-top: 12px;
            display: block;
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .register-link:hover {
            text-decoration: underline;
            color: #1d6fa5;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <?php
            // ดึงชื่อไฟล์ของหน้าปัจจุบัน
            $current_page = basename($_SERVER['PHP_SELF']);

            // ตรวจสอบว่าเป็นหน้าที่ต้องการแสดงเมนูไหน
            if ($current_page === "templat\home_get.php") { ?>
                <!-- เมนูสำหรับหน้า Home -->
                <a href="/">หน้าแรก</a>
                <a href="/login">เข้าสู่ระบบ</a>
                <a href="/register">สมัครสมาชิก</a>
            <?php } elseif ($current_page === "templat\login_get.php") { ?>
                <!-- เมนูสำหรับหน้า Login -->
                <a href="/">หน้าแรก</a>
                <a href="/register">สมัครสมาชิก</a>
            <?php } elseif ($current_page === "templat\Choose_activity_get.php") { ?>
                <!-- เมนูสำหรับหน้า Activity -->
                <a href="/">หน้าแรก</a>
                <a href="/events">อีเวนต์</a>
                <a href="/schedule">ตารางกิจกรรม</a>
                <a href="/login">เข้าสู่ระบบ</a>
            <?php } elseif ($current_page === "templat\register_get.php") { ?>
                <!-- เมนูสำหรับหน้า Register -->
                <a href="/">หน้าแรก</a>
                <a href="/login">เข้าสู่ระบบ</a>
            <?php } else { ?>
                <!-- เมนูปกติสำหรับหน้าอื่น ๆ -->
                <a href="/">หน้าแรก</a>
                <a href="/login">เข้าสู่ระบบ</a>
                <a href="/register">สมัครสมาชิก</a>
            <?php } ?>
        </nav>
    </header>


</body>

</html>