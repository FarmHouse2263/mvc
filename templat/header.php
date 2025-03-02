<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบกิจกรรม</title>
    <link rel="stylesheet" href="css/all.css">
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
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin-left: 20px;
            font-size: 20px;
        }

        /* Hamburger Menu */
        .menu-toggle {
            cursor: pointer;
            display: block;
            position: absolute;
            right: 20px;
            top: 15px;
            width: 30px;
            height: 30px;
        }

        .bar {
            background-color: white;
            height: 3px;
            width: 100%;
            margin: 6px 0;
            transition: 0.4s;
        }

        /* เมนูหลัก */
        .nav-links {
            position: fixed;
            top: 0;
            right: -250px; /* ซ่อนเมนูทางขวา */
            width: 250px;
            height: 100%;
            background: #2c3e50;
            padding-top: 60px;
            transition: 0.4s;
            display: flex;
            flex-direction: column;
            box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            font-size: 18px;
            display: block;
            transition: 0.3s;
        }

        .nav-links a:hover {
            background: #1d6fa5;
        }

        /* เมนูเปิด */
        .nav-links.active {
            right: 0;
        }

        /* ปุ่มปิดเมนู */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }

        /* สำหรับมือถือ */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>ระบบกิจกรรม</h1>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </header>

    <!-- เมนูแถบด้านข้าง -->
    <nav class="nav-links" id="navMenu">
        <span class="close-btn" onclick="toggleMenu()">&times;</span>
        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        if ($current_page === "templat/home_get.php") { ?>
            <a href="/">หน้าแรก</a>
            <a href="/login">เข้าสู่ระบบ</a>
            <a href="/register">สมัครสมาชิก</a>
        <?php } elseif ($current_page === "templat/login_get.php") { ?>
            <a href="/">หน้าแรก</a>
            <a href="/register">สมัครสมาชิก</a>
        <?php } elseif ($current_page === "templat/Choose_activity_get.php") { ?>
            <a href="/">หน้าแรก</a>
            <a href="/events">อีเวนต์</a>
            <a href="/schedule">ตารางกิจกรรม</a>
            <a href="/login">เข้าสู่ระบบ</a>
        <?php } elseif ($current_page === "templat/register_get.php") { ?>
            <a href="/">หน้าแรก</a>
            <a href="/login">เข้าสู่ระบบ</a>
        <?php } else { ?>
            <a href="/">หน้าแรก</a>
            <a href="/login">เข้าสู่ระบบ</a>
            <a href="/register">สมัครสมาชิก</a>
        <?php } ?>
    </nav>

    <script>
        function toggleMenu() {
            var nav = document.getElementById("navMenu");
            nav.classList.toggle("active");
        }
    </script>

</body>

</html>
