<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\all.css">
    <title>Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            text-align: center;
        }

       

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease-in-out;
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        footer {
            background: linear-gradient(90deg, #2c3e50, #34495e);
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 14px;
            box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.2);
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
        <div class="container">
            <h1>ยินดีต้อนรับ!</h1>
            <p>เว็บไซต์ของเรามีกิจกรรมมากมายที่น่าสนใจ</p>
        </div>

    <footer>
        &copy; 2025 My Website | All Rights Reserved
    </footer>

</body>

</html>