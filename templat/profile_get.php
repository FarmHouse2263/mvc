<!doctype html>
<html lang="th">

<head>
    <title>โปรไฟล์ของฉัน</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center">
                <i class="fas fa-user-circle fa-5x text-secondary mb-3"></i>
                <h3><?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></h3>
                <p class="text-muted"><?= $_SESSION['email'] ?></p>
                 <p class="text-muted">   Tel. <?= $_SESSION['phone'] ?></p> 
                <a href="edit_profile.php" class="btn btn-primary">แก้ไขโปรไฟล์</a>
                <a href="/home" class="btn btn-danger">ออกจากระบบ</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
