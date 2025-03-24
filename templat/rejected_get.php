<!doctype html>
<html lang="en">

<head>
    <title>กิจกรรมที่ถูกปฏิเสธ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">กิจกรรมที่ถูกปฏิเสธ</h1>

        <?php if ($rejected->num_rows > 0): ?>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อกิจกรรม</th>
                            <th>ชื่อผู้ขอเข้าร่วม</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rejected as $index => $activity): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($activity['title']) ?></td>
                                <td><?= htmlspecialchars($activity['first_name']) . "&nbsp;&nbsp;&nbsp;" . htmlspecialchars($activity['last_name']) ?></td>
                                <td><span class="badge bg-danger"><?= htmlspecialchars($activity['approval_status']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info mt-3">
                <p class="mb-0">ไม่พบข้อมูลที่ถูกปฏิเสธ</p>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="/choose_activity" class="btn btn-primary">
                <i class="bi bi-house-door"></i> กลับไปหน้าแรก
            </a>
        </div>
    </div>

    <!-- Required JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>