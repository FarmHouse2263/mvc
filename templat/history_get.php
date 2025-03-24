<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>รายละเอียดกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }

        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }

        .table thead {
            position: sticky;
            top: 0;
            background-color: #007bff;
            color: white;
            z-index: 10;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .alert {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
        }

        .info-box {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .info-box:hover {
            transform: translateY(-5px);
        }

        .info-box-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?")) {
                window.location.href = "/route/delete_get.php?id=" + id;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const alertBox = document.getElementById("alert-box");
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 3000);
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
    </script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">
            <i class="bi bi-calendar-check me-2"></i>รายละเอียดกิจกรรม<i class="bi bi-calendar-check ms-2"></i>
            </span>
        </h2>
        <br><br><br>


        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'success'): ?>
            <div id="alert-box" class="alert alert-success text-center">
                กิจกรรมถูกลบสำเร็จ!
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อกิจกรรม</th>
                        <th>รายละเอียด</th>
                        <th>เริ่ม</th>
                        <th>สิ้นสุด</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activitise as $index => $activity): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><img src="<?= htmlspecialchars($activity['image']) ?>" width="100" alt="Activity Image"></td>
                            <td><?= htmlspecialchars($activity['title']) ?></td>
                            <td><?= htmlspecialchars($activity['description']) ?></td>
                            <td><?= htmlspecialchars($activity['start_date']) ?></td>
                            <td><?= htmlspecialchars($activity['end_date']) ?></td>
                            <td><?= htmlspecialchars(getApprovalStatus($activity['aid'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <a href="/choose_activity" class="btn btn-primary mt-3">กลับหน้าหลัก</a>
    </div>
</body>

</html>