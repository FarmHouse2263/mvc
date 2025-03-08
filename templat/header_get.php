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
            padding-top: 70px;
            /* เพิ่มช่องว่างสำหรับเมนูด้านบน */
        }

        header {
            background: linear-gradient(90deg, #3498db, #1d6fa5);
            color: white;
            width: 100%;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin-left: 20px;
            font-size: 20px;
        }

        /* เมนูแถบด้านบน */
        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 16px;
            transition: 0.3s;
            margin: 0 5px;
            border-radius: 4px;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Hamburger Menu สำหรับมือถือ */
        .menu-toggle {
            cursor: pointer;
            display: none;
            width: 30px;
            height: 30px;
            margin-right: 20px;
        }

        .bar {
            background-color: white;
            height: 3px;
            width: 100%;
            margin: 6px 0;
            transition: 0.4s;
        }

        /* สำหรับหน้าจอขนาดเล็ก */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                position: fixed;
                top: 60px;
                left: 0;
                right: 0;
                background: #2c3e50;
                flex-direction: column;
                width: 100%;
                text-align: center;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.4s ease;
            }

            .nav-links a {
                display: block;
                padding: 15px;
                margin: 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-links.active {
                max-height: 500px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <nav class="nav-links" id="navMenu">
            <?php
            $request_uri = $_SERVER['REQUEST_URI'];
            $uri_path = parse_url($request_uri, PHP_URL_PATH);
            $uri_segments = explode('/', trim($uri_path, '/'));
            $current_route = empty($uri_segments[0]) ? 'home' : $uri_segments[0];

            // ตรวจสอบตามเส้นทาง URL
            if ($current_route === "home") { ?>
                <a href="/">หน้าแรก</a>
                <a href="/login">เข้าสู่ระบบ</a>
                <a href="/register">สมัครสมาชิก</a>
                <!-- <a href="/activities">เพิ่มกิจกรรม</a> -->
            <?php } elseif ($current_route === "login") { ?>
                <h1>เข้าสู่ระบบ</h1>
                <a href="/">หน้าแรก</a>
                <a href="/register">สมัครสมาชิก</a>
            <?php } elseif ($current_route === "register") { ?>
                <h1>สมัครสมาชิก</h1>
                <a href="/">หน้าแรก</a>
                <a href="/login">เข้าสู่ระบบ</a>
            <?php } elseif ($current_route === "activities") { ?>
                <h1>เพิ่มกิจกรรม</h1>
                <a href="/Choose_activity">กิจกรรม</a>
                <a href="/route/logout.php" class="logout-button">ออกจากระบบ</a>

            <?php } elseif ($current_route === "Choose_activity") { ?>
                <h1>กิจกรรมทั้งหมด</h1>
                <a href="/activities">เพิ่มกิจกรรม</a>
                <a href="/route/logout.php" class="logout-button">ออกจากระบบ</a>

                <!-- เมนูอื่นๆ ตามต้องการ -->
            <?php } else { ?>
                <!-- เมนูเริ่มต้น -->
                <a href="/">หน้าแรก</a>
                <a href="/login">เข้าสู่ระบบ</a>
                <a href="/register">สมัครสมาชิก</a>
                <a href="/activities">เพิ่มกิจกรรม</a>
            <?php } ?>
        </nav>
    </header>

    <script>
        function toggleMenu() {
            var nav = document.getElementById("navMenu");
            nav.classList.toggle("active");
        }
    </script>

</body>

</html>