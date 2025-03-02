<!DOCTYPE html>
<html lang="en">

<head>
    <title>Choose Activity</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    $activities = getActivities();
    ?>
    <div class="container mt-5">
        <h2 class="text-center">รายการกิจกรรม</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>รายละเอียด</th>
                    <th>วันที่</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <h3><?= htmlspecialchars($activity['name']) ?></h3>
                    <p><strong>Date:</strong> <?= htmlspecialchars($activity['description']) ?></p>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>