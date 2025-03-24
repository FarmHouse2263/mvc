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
            <!-- <span style="background: linear-gradient(to right, #007bff, #00c6ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; padding: 0 10px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);"> -->
            <i class="bi bi-calendar-check me-2"></i>รายการกิจกรรม<i class="bi bi-calendar-check ms-2"></i>
            </span>
        </h2>
        <br> <br> <br>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="info-box bg-primary text-white text-center">
                    <a href="/history?id=<?= $_SESSION['id'] ?>" style="text-decoration: none;">
                        <h5 style="color: white;">ประวัติการขอเข้าร่วมกิจกรรม</h5>
                    </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box bg-success text-white text-center">
                    <a href="/req_activity?id=<?= $_SESSION['id'] ?>" style="text-decoration: none;">
                        <h5 style="color: white;">คำขอเข้าร่วมกิจกรรมที่ได้รับ</h5>
                    </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box bg-warning text-dark text-center">
                    <a href="/accept?id=<?= $_SESSION['id'] ?>" style="text-decoration: none;">
                        <h5 style="color: white;">กิจกรรมที่เข้าร่วมแล้ว</h5>
                    </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box bg-info text-white text-center">
                    <a href="/rejected?id=<?= $_SESSION['id'] ?>" style="text-decoration: none;">
                        <h5 style="color: white;">กิจกรรมที่ถูกปฏิเสธ</h5>
                    </a>
                </div>
            </div>

        </div>

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
                                <a href="/data?id=<?= $activity['aid'] ?>">
                                    <img src="<?= htmlspecialchars($activity['image']) ?>" width="100" alt="Activity Image">
                                </a>
                            </td>

                            <td><?= htmlspecialchars($activity['title']) ?></td>
                            <td><?= htmlspecialchars($activity['description']) ?></td>
                            <td><?= htmlspecialchars($activity['start_date']) ?></td>
                            <td><?= htmlspecialchars($activity['end_date']) ?></td>
                            <td>
                                <?php if ($activity['organizer_id'] == $_SESSION['id']): ?>
                                    <a href="/edit?id=<?= $activity['aid'] ?>" class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i> แก้ไข
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $activity['aid'] ?>)">
                                        <i class="bi bi-trash"></i> ลบ
                                    </button>
                                <?php else: ?>
                                    <p class="text-danger">เจ้าของเท่านั้นจึงจะมีสิทธิ์แก้ไขหรือลบได้</p>
                                <?php endif; ?>
                                <script>
                                    function confirmDelete(id) {
                                        if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?")) {
                                            window.location.href = "/delete?id=" + id;
                                        }
                                    } //155 -170 คือ เอาเช็ค 155 รับค่า id ไว้ใน session แล้วเอามาเปรียบเทียบเอาค่า organizer_id ของเป็นกิจกรรมของใคร 

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