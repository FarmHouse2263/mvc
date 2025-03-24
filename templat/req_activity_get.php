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

        .no-requests {
            text-align: center;
            font-size: 1.2rem;
            color: #6c757d;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
    <script>
        function confirmApprove(ap_id) {
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการอนุมัติผู้ขอเข้าร่วมกิจกรรมคนนี้?")) {
                window.location.href = "/approve?ap_id=" + ap_id;
            }
        }

        function confirmReject(ap_id) {
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการปฏิเสธผู้ขอเข้าร่วมกิจกรรมคนนี้?")) {
                window.location.href = "/reject?ap_id=" + ap_id;
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

            // Hide table and show "No requests" message if no activities exist
            const tableContainer = document.querySelector('.table-container');
            const noRequestsMessage = document.getElementById('no-requests-message');
            const rows = tableContainer.querySelector('tbody').rows;
            if (rows.length === 0) {
                tableContainer.style.display = 'none';
                noRequestsMessage.style.display = 'block';
            }
        });
    </script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">
            <i class="bi bi-calendar-check me-2"></i>รายการคำขอ<i class="bi bi-calendar-check ms-2"></i>
        </h2>

        <!-- ตรวจสอบและแสดงข้อความแจ้งเตือน -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success text-center" id="alert-box">
                <?= $_SESSION['message'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <br><br><br>

        <!-- ข้อความเมื่อไม่มีรายการคำขอ -->
        <div class="no-requests" id="no-requests-message" style="display: none;">
            ไม่มีรายการคำขอกิจกรรมที่ได้รับ
        </div>

        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อกิจกรรม</th>
                        <th>ชื่อผู้ขอร่วมกิจกรรม</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activitise as $index => $activity): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($activity['title']) ?></td>
                            <td><?= htmlspecialchars($activity['first_name']) . "&nbsp;&nbsp;&nbsp;" . htmlspecialchars($activity['last_name']) ?></td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="confirmApprove(<?= $activity['ap_id'] ?>)">
                                    <i class="bi bi-check-circle"></i> อนุมัติ
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="confirmReject(<?= $activity['ap_id'] ?>)">
                                    <i class="bi bi-x-circle"></i> ปฏิเสธ
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="/choose_activity" class="btn btn-primary mt-3">กลับหน้าหลัก</a>
    </div>
</body>

</html>