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
            color: #333;
            line-height: 1.6;
        }

        .container {
            margin-top: 10vh;
        }

        .card-container {
            max-width: 800px;
            margin: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 50px;
            border: none;
            background-color: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 1px solid #eaeaea;
        }

        .card-title {
            color: #2563eb;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 25px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 15px;
            position: relative;
        }

        .card-title:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 80px;
            height: 3px;
            background-color: #2563eb;
        }

        .card-body {
            padding: 30px;
        }

        .card-text {
            font-size: 18px;
            line-height: 1.8;
            color: #4b5563;
            text-align: justify;
        }

        .detail-item {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .detail-label {
            width: 120px;
            font-weight: 600;
            color: #374151;
            font-size: 16px;
        }

        .detail-value {
            flex: 1;
            color: #1f2937;
            font-size: 16px;
        }

        .back-btn {
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            margin-top: 30px;
            background-color: #2563eb;
            border: none;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.25);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(37, 99, 235, 0.3);
        }

        .activity-meta {
            background-color: #f0f9ff;
            border-radius: 12px;
            padding: 20px 25px;
            margin: 25px 0;
            border-left: 5px solid #2563eb;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            color: #1f2937;
            font-weight: 700;
            font-size: 32px;
            position: relative;
            padding-bottom: 15px;
        }

        .alert {
            border-radius: 12px;
            padding: 20px;
            font-weight: 500;
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        h5 {
            color: #2563eb;
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .fas {
            color: #2563eb;
        }

        .card-img-top {
            width: 100%;    
            height: 300px;
            object-fit: cover;
            border-bottom: 1px solid #eaeaea;
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
                <img src="<?= htmlspecialchars($activity['image']) ?>" class="card-img-top" alt="Activity Image">

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
                        <form action="/history" method="POST">
                            <input type="hidden" name="activity_id" value="<?= htmlspecialchars($activity['aid']) ?>">
                            <input type="hidden" name="rid" value="<?= htmlspecialchars($_SESSION['id']) ?>">
                            <input type="hidden" name="title" value="<?= htmlspecialchars($activity['title']) ?>">
                            <input type="hidden" name="start_date" value="<?= htmlspecialchars($activity['start_date']) ?>">
                            <input type="hidden" name="end_date" value="<?= htmlspecialchars($activity['end_date']) ?>">
                            <input type="hidden" name="location" value="<?= htmlspecialchars($activity['location'] ?? '') ?>">
                            <input type="hidden" name="description" value="<?= htmlspecialchars($activity['description'] ?? '') ?>">

                            <button type="submit" class="btn btn-primary back-btn">
                                <i class="fas fa-check-circle me-2"></i> เลือกกิจกรรม
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
