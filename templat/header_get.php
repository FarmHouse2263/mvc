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

        /* ส่วนของการค้นหา */
        .search-container {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 5px 10px;
            margin: 0 15px;
        }

        .search-container input {
            background: transparent;
            border: none;
            outline: none;
            color: white;
            width: 200px;
            font-size: 14px;
            padding: 5px;
        }

        .search-container input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-container button {
            background: transparent;
            border: none;
            cursor: pointer;
            color: white;
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

            .search-container {
                width: 100%;
                margin: 10px 0;
            }

            .profile-container {
                margin: 10px 0;
            }

            header {
                flex-wrap: wrap;
            }

            header h1 {
                width: 100%;
                text-align: center;
                margin-left: 0;
                margin-bottom: 10px;
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
                <a href="/home">ออกจากระบบ</a>


                <!-- เพิ่มโปรไฟล์ -->
                <div class="profile-container">
                    <span class="user-email">
                        <h5 class="text-white"><?= $_SESSION['first_name'] ?></h5>
                    </span>
                    <div class="profile-icon" onclick="toggleProfileMenu()">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-menu" id="profileMenu">
                        <a href="/profile"><i class="fas fa-user-circle"></i> โปรไฟล์</a>
                        <a href="/settings"><i class="fas fa-cog"></i> ตั้งค่า</a>
                        <a href="/home" class="logout-button"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                    </div>
                </div>


            <?php } elseif ($current_route === "Choose_activity") { ?>
                <h1>กิจกรรมทั้งหมด</h1>
                <a href="/activities">เพิ่มกิจกรรม</a>
                <a href="/home">ออกจากระบบ</a>



                <!-- เพิ่มช่องค้นหา -->
                <!-- ส่วนของการค้นหา -->
                <div class="search-container">
                    <form action="/seart" method="GET">
                        <input type="text" placeholder="ค้นหากิจกรรม..." name="search" id="searchInput">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>

                    <?php
                    if (isset($activity['activitise'])) {
                        while ($row = $activity['activitise']->fetch_object()) {
                    ?>
                            <?= $row->title ?>

                    <?php
                        }
                    }
                    ?>
                </div>


                <!-- เพิ่มโปรไฟล์ -->
                <div class="profile-container">
                    <span class="user-email">
                        <h5 class="text-white"><?= $_SESSION['first_name'] ?></h5>
                    </span>
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-menu">
                        <!-- <a href="/profile"><i class="fas fa-user-circle"></i> โปรไฟล์</a> -->

                    </div>
                </div>

            <?php } elseif ($current_route === "edit") { ?>
                <h1>แก้ไขข้อมูล</h1>
                <a href="/activities">เพิ่มกิจกรรม</a>
                <a href="/Choose_activity">กิจกรรม</a>


                <!-- เพิ่มโปรไฟล์ -->
                <div class="profile-container">
                    <span class="user-email">
                        <h5 class="text-white"><?= $_SESSION['first_name'] ?></h5>
                    </span>
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-menu">
                        <a href="/profile"><i class="fas fa-user-circle"></i> โปรไฟล์</a>
                        <a href="/settings"><i class="fas fa-cog"></i> ตั้งค่า</a>
                        <a href="/home" class="logout-button"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                    </div>
                </div>

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
        });
    </script>

</body>

</html>