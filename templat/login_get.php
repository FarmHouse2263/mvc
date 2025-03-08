<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css\all.css"> -->
    <title>เข้าสู่ระบบ</title>
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

    <!-- ส่วนของฟอร์มเข้าสู่ระบบ -->
    <div class="login-container">
        <h2>เข้าสู่ระบบ</h2>
        <form action="/login" method="post">
            <input href="https://icons.veryicon.com/png/o/miscellaneous/icon-8/my-account-5.png" type="text" name="username" placeholder="ชื่อผู้ใช้" required>
            <input type="password" name="password" placeholder="รหัสผ่าน" required>
            <button type="submit" class="btn">เข้าสู่ระบบ</button>
        </form>
        <a href="/register" class="register-link">ยังไม่มีบัญชี? สมัครสมาชิก</a>
    </div>
</body>

</html>