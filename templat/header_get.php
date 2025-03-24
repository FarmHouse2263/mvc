<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบกิจกรรม</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            min-height: 100vh;
            flex-direction: column;
            padding-top: 70px;
            width: 100%;
        }

        header {
            background: linear-gradient(90deg, #3498db, #1d6fa5);
            color: white;
            width: 100%;
            padding: 0;
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
            margin: 0;
            padding: 15px 20px;
            font-size: 20px;
        }

        /* เมนูแถบด้านบน */
        .nav-links {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0 20px;
            justify-content: space-between;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 15px;
            font-size: 16px;
            transition: 0.3s;
            white-space: nowrap;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* ส่วนของการค้นหา */
        .search-container {
            width: auto;
            max-width: 220px;
            margin: 0 15px;
        }

        .search-container form {
            display: flex;
            align-items: center;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            border-radius: 18px;
            padding: 4px 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .search-container form:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .search-container input {
            background: transparent;
            border: none;
            outline: none;
            color: white;
            width: 100%;
            font-size: 13px;
            padding: 4px;
            transition: all 0.3s ease;
        }

        .search-container input::placeholder {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 300;
        }

        .search-container button {
            background: transparent;
            border: none;
            cursor: pointer;
            color: white;
            padding: 0 4px;
            margin-left: 5px;
            opacity: 0.8;
            transition: all 0.2s ease;
        }

        .search-container button:hover {
            opacity: 1;
        }

        .search-container button i {
            font-size: 14px;
        }

        /* เพิ่มเอฟเฟกต์โฟกัส */
        .search-container form:focus-within {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.4);
        }

        /* ส่วนของโปรไฟล์ */
        .profile-container {
            display: flex;
            align-items: center;
            margin-left: 10px;
            position: relative;
        }

        .profile-icon {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .profile-menu {
            position: absolute;
            top: 45px;
            right: 0;
            background: white;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 200px;
            display: none;
            z-index: 10;
        }

        .profile-menu a {
            display: block;
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            border-bottom: 1px solid #eee;
        }

        .profile-menu a:hover {
            background: #f5f5f5;
        }

        .profile-container:hover .profile-menu {
            display: block;
        }

        .user-email {
            color: white;
            margin-right: 10px;
            font-size: 14px;
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ส่วนของการค้นหาตามวันที่ */



        /* Hamburger Menu สำหรับมือถือ */
        .menu-toggle {
            cursor: pointer;
            display: none;
            width: 30px;
            height: 30px;
            padding: 15px;
        }

        .bar {
            background-color: white;
            height: 3px;
            width: 100%;
            margin: 6px 0;
            transition: 0.4s;
        }

        /* สำหรับหน้าจอขนาดเล็ก */
        @media (max-width: 992px) {
            .nav-links {
                padding: 0;
            }

            .search-container {
                max-width: 200px;
            }

            .date-search {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
                position: absolute;
                top: 10px;
                right: 10px;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 0;
            }

            header h1 {
                width: calc(100% - 60px);
                padding: 10px 15px;
            }

            .nav-links {
                position: fixed;
                top: 60px;
                left: -100%;
                right: auto;
                background: #1d6fa5;
                flex-direction: column;
                width: 80%;
                height: calc(100vh - 60px);
                align-items: flex-start;
                padding: 0;
                transition: left 0.3s ease;
                overflow-y: auto;
            }

            .nav-links.active {
                left: 0;
            }

            .nav-left,
            .nav-right {
                flex-direction: column;
                width: 100%;
                align-items: flex-start;
            }

            .nav-links a {
                width: 100%;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding: 15px 20px;
            }

            .search-container {
                width: 100%;
                max-width: 100%;
                margin: 10px 20px;
                box-sizing: border-box;
            }

            .profile-container {
                width: 100%;
                justify-content: flex-start;
                padding: 15px 20px;
                margin-left: 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .profile-menu {
                width: 90%;
                left: 5%;
                right: 5%;
            }
        }

        /* ส่วนของการค้นหาตามวันที่ */
        /* ส่วนของการค้นหาตามวันที่ */
        .date-search {
            margin: 0 15px;
        }



        .date-search .mb-3 {
            max-width: 140px;
            /* ลดขนาดให้กะทัดรัด */
            margin-bottom: 0;
        }

        .date-search label {
            color: rgba(255, 255, 255, 0.85);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            display: block;
        }

        .date-search .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 6px 8px;
            /* ลด padding เพื่อให้ขนาดเล็กลง */
            border-radius: 5px;
            font-size: 12px;
            width: 100%;
            transition: all 0.3s ease;
            height: 34px;
            /* ลดความสูงของ input */
        }

        .date-search .form-control:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .date-search .form-control:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 3px rgba(255, 255, 255, 0.4);
        }

        /* ปุ่มค้นหา */
        .date-search .btn {
            background: #f1c40f;
            border: none;
            color: #333;
            padding: 6px 14px;
            /* ลด padding ให้ปุ่มเล็กลง */
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            /* font-weight: 600; */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            height: 34px;
            /* ให้ความสูงเท่ากับช่อง input */
        }


        .date-search .btn:hover {
            background: #e1b50e;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transform: translateY(-1px);
        }

        .date-search .btn i {
            margin-right: 5px;
            font-size: 12px;
        }

        /* ปรับให้รองรับมือถือ */
        @media (max-width: 768px) {
            .date-search form {
                flex-direction: column;
                align-items: stretch;
                padding: 8px;
            }

            .date-search .mb-3 {
                max-width: none;
                margin-bottom: 8px;
            }

            .date-search .btn {
                width: 100%;
                margin-top: 5px;
            }

            .profile-img {
            width: 1px;
            /* ปรับขนาดรูปภาพ */
            height: 1px;
            border-radius: 50%;
            /* ทำให้เป็นวงกลม */
            object-fit: cover;
            /* ป้องกันภาพบิดเบี้ยว */
            border: 3px solid #ddd;
            /* เพิ่มเส้นขอบ */
            margin-bottom: 15px;
        }
        }
    </style>
</head>

<body>
    <!-- เพิ่ม Snow container div -->
    <div id="snow-container" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1;"></div>

    <header>
        <h1>กิจกรรม</h1>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <nav class="nav-links" id="navMenu">
            <div class="nav-left">
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
                <?php } elseif ($current_route === "login") { ?>
                    <a href="/">หน้าแรก</a>
                    <a href="/register">สมัครสมาชิก</a>
                <?php } elseif ($current_route === "register") { ?>
                    <a href="/">หน้าแรก</a>
                    <a href="/login">เข้าสู่ระบบ</a>
                <?php } elseif ($current_route === "activities") { ?>
                    <a href="/choose_activity">กิจกรรม</a>
                    <a href="/home">ออกจากระบบ</a>
                <?php } elseif ($current_route === "choose_activity") { ?>
                    <?php
                    if (isset($_SESSION['activities']) && !empty($_SESSION['activities'])): ?>
                        <a href="/choose_activity">กิจกรรมทั้งหมด</a>
                    <?php else: ?>
                        <!-- เป็นหน้ากิจกรรมทั้งหมดอยู่แล้ว ไม่ต้องแสดงลิงก์ -->
                    <?php endif; ?>
                    <a href="/activities">เพิ่มกิจกรรม</a>
                    <a href="/home">ออกจากระบบ</a>
                <?php } elseif ($current_route === "edit") { ?>
                    <a href="/activities">เพิ่มกิจกรรม</a>
                    <a href="/choose_activity">กิจกรรม</a>
                <?php } else { ?>
                    <!-- เมนูเริ่มต้น -->
                    <a href="/choose_activity">กิจกรรมทั้งหมด</a>
                    <a href="/activities">เพิ่มกิจกรรม</a>
                <?php } ?>
            </div>

            <div class="nav-right">
                <?php if ($current_route === "choose_activity") { ?>
                    <!-- ส่วนของการค้นหา -->
                    <div class="search-container">
                        <form action="/seart" method="GET">
                            <input type="text" placeholder="ค้นหากิจกรรม..." name="search" id="searchInput">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <!-- ส่วนของการค้นหาตามวันที่ -->
                    <div class="date-search">
                        <form action="/searchdate" method="GET" class="d-flex align-items-center gap-2">
                            <div class="position-relative">
                                <!-- <label for="start_date" class="input-placeholder">วันที่เริ่มกิจกรรม</label> -->
                                <input type="datetime-local" class="form-control date-input" id="start_date" name="start_date" required>
                            </div>

                            <div class="position-relative">
                                <!-- <label for="end_date" class="input-placeholder">วันที่สิ้นสุดกิจกรรม</label> -->
                                <input type="datetime-local" class="form-control date-input" id="end_date" name="end_date" required>
                            </div>

                            <button type="submit" class="btn btn-warning search-btn">
                                <i class="fas fa-search"></i> <span class="ml-2">ค้นหา</span>
                            </button>
                        </form>
                    </div>


                <?php } ?>

                <?php if (in_array($current_route, ["activities", "choose_activity", "edit"])) { ?>
                    <!-- ส่วนของโปรไฟล์ -->
                    <div class="profile-container">
                        <span class="user-email">
                            <h5 class="text-white"><?= $_SESSION['first_name'] ?></h5>
                        </span>
                        <a href="/profile" class="profile-icon">
                        <img src="<?= !empty($_SESSION['image']) ? htmlspecialchars($_SESSION['image']) : 'default.jpg' ?>"
                        alt="Profile Image" class="profile-icon">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </nav>
    </header>

    <script>
        function toggleMenu() {
            var nav = document.getElementById("navMenu");
            nav.classList.toggle("active");
        }

        // ฟังก์ชันสำหรับการค้นหา
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function(event) {
                    if (event.key === 'Enter') {
                        // ดำเนินการค้นหา
                        const searchTerm = searchInput.value.trim();
                        if (searchTerm) {
                            // ส่งคำค้นหาไปยัง URL ที่ต้องการ (เช่น /search?q=คำค้นหา)
                            window.location.href = '/search?q=' + encodeURIComponent(searchTerm);
                        }
                    }
                });
            }

            // เพิ่ม code สำหรับสร้างหิมะ
            createSnowflakes();
        });

        // ฟังก์ชันสร้างหิมะตก
        function createSnowflakes() {
            const snowContainer = document.getElementById('snow-container');
            const snowflakeCount = 50; // จำนวนเกล็ดหิมะ

            for (let i = 0; i < snowflakeCount; i++) {
                createSnowflake(snowContainer);
            }
        }

        function createSnowflake(container) {
            const snowflake = document.createElement('div');

            // สร้างรูปแบบของเกล็ดหิมะ
            snowflake.innerHTML = '❄';
            snowflake.style.position = 'absolute';
            snowflake.style.color = 'white';
            snowflake.style.userSelect = 'none';
            snowflake.style.opacity = (Math.random() * 0.8 + 0.2).toString();

            // กำหนดขนาดเกล็ดหิมะแบบสุ่ม
            const size = Math.random() * 20 + 10;
            snowflake.style.fontSize = `${size}px`;

            // กำหนดตำแหน่งเริ่มต้นแบบสุ่ม
            const startPositionX = Math.random() * window.innerWidth;
            const startPositionY = -50; // เริ่มจากด้านบนของหน้าจอ

            snowflake.style.left = `${startPositionX}px`;
            snowflake.style.top = `${startPositionY}px`;

            // เพิ่มเกล็ดหิมะลงในคอนเทนเนอร์
            container.appendChild(snowflake);

            // กำหนดการเคลื่อนที่ของเกล็ดหิมะ
            animateSnowflake(snowflake);
        }

        function animateSnowflake(snowflake) {
            // กำหนดค่าความเร็วในการตกแบบสุ่ม
            const speed = Math.random() * 2 + 0.5;
            // กำหนดค่าการส่ายซ้ายขวาแบบสุ่ม
            const wobbleSpeed = Math.random() * 2;
            const wobbleAmount = Math.random() * 30;

            // ตำแหน่งเริ่มต้น
            let positionX = parseFloat(snowflake.style.left);
            let positionY = parseFloat(snowflake.style.top);
            let angle = Math.random() * 2 * Math.PI; // มุมเริ่มต้นแบบสุ่ม

            function updatePosition() {
                // คำนวณตำแหน่งใหม่
                positionY += speed;
                positionX += Math.sin(angle) * wobbleAmount / 10;
                angle += wobbleSpeed / 100;

                // อัพเดทตำแหน่ง CSS
                snowflake.style.top = `${positionY}px`;
                snowflake.style.left = `${positionX}px`;

                // ตรวจสอบว่าเกล็ดหิมะตกลงด้านล่างของหน้าจอหรือไม่
                if (positionY < window.innerHeight) {
                    requestAnimationFrame(updatePosition);
                } else {
                    // ถ้าตกลงด้านล่างแล้วให้ลบและสร้างเกล็ดหิมะใหม่
                    snowflake.remove();
                    createSnowflake(document.getElementById('snow-container'));
                }
            }

            // เริ่มการเคลื่อนที่
            updatePosition();
        }
    </script>

</body>

</html>