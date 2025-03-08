<!DOCTYPE html>
<html lang="th">

<head>
    <title>เลือกกิจกรรม</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        function confirmDelete(id) {
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?")) {
                window.location.href = "/route/delete_get.php?id=" + id;
            }
        }
    </script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">รายการกิจกรรม</h2>

        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'success'): ?>
            <div class="alert alert-success" role="alert">
                กิจกรรมถูกลบสำเร็จ!
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รูปภาพ</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>รายละเอียด</th>
                    <th>วันที่สร้าง</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activitise as $index => $activity): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($activity['image_url']) ?>" class="table-img" alt="Activity Image" width="100">
                        </td>
                        <td><?= htmlspecialchars($activity['name']) ?></td>
                        <td><?= htmlspecialchars($activity['description']) ?></td>
                        <td><?= htmlspecialchars($activity['created_at']) ?></td>
                        <td>
                            <a href="/route/edit_get.php?id=<?= $activity['id'] ?>" class="btn btn-success btn-sm">
                                <i class="bi bi-pencil-square"></i> แก้ไข
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $activity['id'] ?>)">
                                <i class="bi bi-trash"></i> ลบ
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>

</html>
