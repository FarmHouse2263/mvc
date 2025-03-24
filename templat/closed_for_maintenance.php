<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ปิดปรับปรุง</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@300;500;700&display=swap');
        
        body {
            font-family: 'Mitr', sans-serif;
            background: linear-gradient(135deg, #0d2f63 0%, #0077cc 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }
        
        .container {
            text-align: center;
            padding: 40px 60px;
            background-color: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 20, 80, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
            animation: float 6s ease-in-out infinite;
        }
        
        h1 {
            color: #ffffff;
            font-size: 70px;
            margin: 0;
            padding: 0;
            letter-spacing: 2px;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
            font-weight: 700;
            background: linear-gradient(to bottom, #ffffff, #a0dbff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 3s infinite;
        }
        
        .snowflake {
            position: fixed;
            top: -10vh;
            color: #fff;
            font-size: 1em;
            text-shadow: 0 0 5px #fff;
            user-select: none;
            z-index: 0;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
                box-shadow: 0 10px 40px rgba(0, 20, 80, 0.3);
            }
            50% {
                transform: translateY(-15px);
                box-shadow: 0 25px 50px rgba(0, 20, 80, 0.2);
            }
            100% {
                transform: translateY(0px);
                box-shadow: 0 10px 40px rgba(0, 20, 80, 0.3);
            }
        }
        
        @keyframes shine {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        @keyframes snowfall {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(110vh) rotate(360deg);
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>ปิดปรับปรุง</h1>
    </div>

    <script>
        // สร้างเอฟเฟกต์หิมะตก
        const snowflakes = 200; // จำนวนเกล็ดหิมะ
        const snowflakeChars = ['❅', '❆', '❄', '✱', '✻'];
        
        function createSnowflakes() {
            for (let i = 0; i < snowflakes; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                
                // สุ่มคุณสมบัติเกล็ดหิมะ
                const size = Math.random() * 1.2 + 0.2; // 0.2-1.4em
                const char = snowflakeChars[Math.floor(Math.random() * snowflakeChars.length)];
                const horizontalPosition = Math.random() * 100; // 0-100%
                const startOpacity = Math.random() * 0.7 + 0.3; // 0.3-1
                const fallDuration = Math.random() * 10 + 8; // 8-18s
                const fallDelay = Math.random() * 10; // 0-10s
                const sway = Math.random() * 30 - 15; // -15px to 15px
                
                // ตั้งค่าสไตล์
                snowflake.innerHTML = char;
                snowflake.style.left = horizontalPosition + '%';
                snowflake.style.fontSize = size + 'em';
                snowflake.style.opacity = startOpacity;
                
                // กำหนด animation
                snowflake.style.animation = `snowfall ${fallDuration}s linear ${fallDelay}s infinite`;
                
                // สร้าง keyframes เฉพาะสำหรับเกล็ดหิมะนี้
                const styleElement = document.createElement('style');
                const keyFrameName = `snowfall-${i}`;
                
                const keyframes = `
                    @keyframes ${keyFrameName} {
                        0% {
                            transform: translate(0, 0) rotate(0deg);
                        }
                        25% {
                            transform: translate(${sway}px, 25vh) rotate(90deg);
                        }
                        50% {
                            transform: translate(${-sway}px, 50vh) rotate(180deg);
                        }
                        75% {
                            transform: translate(${sway}px, 75vh) rotate(270deg);
                        }
                        100% {
                            transform: translate(0, 110vh) rotate(360deg);
                        }
                    }
                `;
                
                styleElement.innerHTML = keyframes;
                document.head.appendChild(styleElement);
                
                // ใช้ keyframes เฉพาะที่สร้างขึ้น
                snowflake.style.animation = `${keyFrameName} ${fallDuration}s linear ${fallDelay}s infinite`;
                
                // เพิ่มเกล็ดหิมะลงใน body
                document.body.appendChild(snowflake);
            }
        }
        
        // เรียกใช้ฟังก์ชัน
        window.addEventListener('load', createSnowflakes);
    </script>
</body>
</html>