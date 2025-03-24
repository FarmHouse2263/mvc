<!doctype html>
<html lang="th">

<head>
    <title>แก้ไขโปรไฟล์</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center">
                           <img src="<?= !empty($user['image']) ? htmlspecialchars($user['image']) : 'default.jpg' ?>" 
                    alt="Profile Image" class="profile-img">
            </div>
            <form action="/edit_profile" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">อัปโหลดรูปภาพ</label>
                    <input type="file" name="image[]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a href="/profile" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>