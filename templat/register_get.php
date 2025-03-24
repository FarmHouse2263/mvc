<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css\all.css"> -->
    <title>สมัครสมาชิก</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        .register-container {
            margin-top: 30vh;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            background-color: #2ecc71;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .btn:hover {
            background-color: #27ae60;
        }

        .login-link {
            margin-top: 10px;
            display: block;
            color: #2ecc71;
            text-decoration: none;
            font-size: 14px;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-container {
            animation: slideDown 0.8s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>สมัครสมาชิก</h2>
        <form action="/register" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($activity['id'] ?? '') ?>">
            <input type="text" name="first_name" placeholder="ชื่อจริง" required>
            <input type="text" name="last_name" placeholder="นามสกุล" required>
            <input type="email" name="email" placeholder="อีเมล" required>
            <input type="password" name="password" placeholder="รหัสผ่าน" required>
            <input type="tel" name="phone" placeholder="หมายเลขโทรศัพท์" required>
            <input type="date" name="birthday" placeholder="วันเกิด" required>
            <select name="user_type" required>
                <option value="men">ชาย</option>
                <option value="women">หญิง</option>
            </select>
            <input type="file" name="image[]" accept="image/*">
            <button type="submit" class="btn">สมัครสมาชิก</button>
        </form>

        <a href="/login" class="login-link">มีบัญชีแล้ว? เข้าสู่ระบบ</a>
    </div>
</body>

</html>

