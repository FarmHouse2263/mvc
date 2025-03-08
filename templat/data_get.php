<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
            background-color: #f8f9fa;
            font-family: 'Sarabun', sans-serif;
        }

        .card-container {
            max-width: 800px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 50px;
        }

        .card-img-top {
            height: 20px;
            object-fit: cover;
        }

        .card-title {
            color: #0d6efd;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 15px;
        }

        .card-text {
            font-size: 18px;
            line-height: 1.6;
            color: #212529;
        }

        .detail-item {
            display: flex;
            margin-bottom: 10px;
        }

        .detail-label {
            width: 120px;
            font-weight: bold;
            color: #495057;
        }

        .detail-value {
            flex: 1;
        }

        .back-btn {
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 50px;
            margin-top: 20px;
        }

        .activity-meta {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 20px 0;
            border-left: 5px solid #0d6efd;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
            color: #495057;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="page-header">รายละเอียดกิจกรรม</h2>

        <?php if (!isset($activity) || empty($activity)): ?>
            <div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-circle"></i> ไม่พบข้อมูลกิจกรรม
            </div>
        <?php else: ?>
            <div class="card card-container">
                <img src="<?= htmlspecialchars($activity['image'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($activity['title'] ?? 'ไม่มีชื่อกิจกรรม') ?>">

                <div class="card-body">
                    <h3 class="card-title"><?= htmlspecialchars($activity['title'] ?? 'ไม่มีชื่อกิจกรรม') ?></h3>

                    <div class="activity-meta">
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-calendar-alt me-2"></i> วันที่เริ่ม:</div>
                            <div class="detail-value"><?= htmlspecialchars($activity['start_date'] ?? '-') ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-calendar-alt me-2"></i> สิ้นสุด:</div>
                            <div class="detail-value"><?= htmlspecialchars($activity['end_date'] ?? '-') ?></div>
                        </div>

                        <?php if (!empty($activity['location'])): ?>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-map-marker-alt me-2"></i> สถานที่:</div>
                                <div class="detail-value"><?= htmlspecialchars($activity['location']) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <h5 class="mt-4 mb-3">รายละเอียด:</h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($activity['description'] ?? 'ไม่มีรายละเอียด')) ?></p>

                    <div class="text-center mt-4">
                        <a href="/Choose_activity" class="btn btn-primary back-btn">
                            <i class="fas fa-check-circle me-2"></i> เลือกกิจกรรม
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>