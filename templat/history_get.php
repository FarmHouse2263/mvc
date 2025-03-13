<!DOCTYPE html>
<html lang="th">

<head>
    <title>เลือกกิจกรรม</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
</head>

<body>
    <div class="container mt-3">
        <h2 class="text-center">
            <span style="background: linear-gradient(to right, #007bff, #00c6ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; padding: 0 10px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                <i class="bi bi-calendar-check me-2"></i>รายการประวัติการขอเข้าร่วมกิจกรรม<i class="bi bi-calendar-check ms-2"></i>
            </span>
        </h2>
        <br> <br> <br>


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
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activitise as $index => $activity): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <img onclick="goToDetail(<?= $activity['aid'] ?>)" src="<?= htmlspecialchars($activity['image']) ?>" class="table-img" alt="Activity Image" width="100">

                            </td>
                            <td><?= htmlspecialchars($activity['title']) ?></td>
                            <td><?= htmlspecialchars($activity['description']) ?></td>
                            <td><?= htmlspecialchars($activity['start_date']) ?></td>
                            <td><?= htmlspecialchars($activity['end_date']) ?></td>
                            <td style="color: <?= $activity['status'] == 'approved' ? 'green' : ($activity['status'] == 'pending' ? 'orange' : ($activity['status'] == 'rejected' ? 'red' : 'black')) ?>">
                                <?= htmlspecialchars($activity['status']) ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>