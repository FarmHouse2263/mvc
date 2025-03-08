<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    $activitise = getActivities();
    ?>
    <div class="container mt-5">
        <h2 class="text-center">แก้ไขกิจกรรม</h2>
        <div class="card shadow p-4">
            <form action="/edit" method="POST">
                <div class="mb-3">
                    <label class="form-label">ชื่อกิจกรรม</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($activity['name'] ?? '') ?>" required>

                </div>
                <div class="mb-3">
                    <label class="form-label">รายละเอียด</label>
                    <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($activity['description'] ?? '') ?></textarea>

                </div>
                <div class="mb-3">
                    <label class="form-label">วันที่</label>
                    <input type="date" name="created_at" class="form-control" value="<?= htmlspecialchars($activity['created_at'] ?? '') ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> บันทึก</button>
                    <a href="/Choose_activity" class="btn btn-secondary"><i class="bi bi-x-circle"></i> ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast แจ้งเตือน -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ แก้ไขกิจกรรมสำเร็จ!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

</body>

</html>