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
    <div class="container mt-3">
        <h2 class="text-center">รายการกิจกรรม</h2>

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
                            <td>
                                <img onclick="goToDetail(<?= $activity['aid'] ?>)" src="<?= htmlspecialchars($activity['image']) ?>" class="table-img" alt="Activity Image" width="100">

                            </td>
                            <td><?= htmlspecialchars($activity['title']) ?></td>
                            <td><?= htmlspecialchars($activity['description']) ?></td>
                            <td><?= htmlspecialchars($activity['start_date']) ?></td>
                            <td><?= htmlspecialchars($activity['end_date']) ?></td>
                            <td>
                                <a href="/edit?id=<?= $activity['aid'] ?>" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i> แก้ไข
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $activity['aid'] ?>)">
                                    <i class="bi bi-trash"></i> ลบ
                                </button>
                                <script>
                                    function confirmDelete(id) {
                                        if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?")) {
                                            window.location.href = "/delete?id=" + id;
                                        }
                                    }

                                    function goToDetail(id) {
                                        window.location.href = "/data?id=" + id;
                                    }
                                </script>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>