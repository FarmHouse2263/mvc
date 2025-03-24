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
    <div class="container mt-5">
        <form action="/edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $activity['aid'] ?>">
            <!-- เพิ่ม hidden field เพื่อเก็บชื่อไฟล์รูปภาพเดิม -->
            <input type="hidden" name="current_image" value="<?= htmlspecialchars($activity['image']) ?>">

            <div class="mb-3">
                <label for="activity_name" class="form-label">ชื่อกิจกรรม</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($activity['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="activity_description" class="form-label">รายละเอียดกิจกรรม</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($activity['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="activity_image" class="form-label">ภาพกิจกรรม</label>
                <input type="file" class="form-control" id="new_image" name="new_image">
                <small class="form-text text-muted">เลือกรูปภาพใหม่หากต้องการเปลี่ยน หากไม่เลือก จะใช้รูปภาพเดิม</small>
                <?php if (!empty($activity['image'])): ?>
                    <div class="mt-2">
                        <img src="<?= htmlspecialchars($activity['image']) ?>" alt="Current Image" class="img-thumbnail" width="200">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">วันที่เริ่มกิจกรรม</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                    value="<?= date('Y-m-d\TH:i', strtotime($activity['start_date'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">วันที่สิ้นสุดกิจกรรม</label>
                <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                    value="<?= date('Y-m-d\TH:i', strtotime($activity['end_date'])) ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> บันทึก</button>
                <a href="/choose_activity" class="btn btn-secondary"><i class="bi bi-x-circle"></i> ยกเลิก</a>
            </div>
        </form>
    </div>

    <!-- Toast แจ้งเตือน -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    แก้ไขกิจกรรมสำเร็จ!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</body>

</html>