<!doctype html>
<html lang="th">

<head>
    <title>เพิ่มกิจกรรม</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body>
<!-- <div class="table-title">
            <h2>รายการกิจกรรม</h2>
        </div>     -->

    <div class="container mt-5">
        <form action="activities" method="POST">
            <div class="mb-3">
                <label for="activity_name" class="form-label">ชื่อกิจกรรม</label>
                <input type="text" class="form-control" id="activity_name" name="activity_name" required>
            </div>

            <div class="mb-3">
                <label for="activity_description" class="form-label">รายละเอียดกิจกรรม</label>
                <textarea class="form-control" id="activity_description" name="activity_description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="activity_image" class="form-label">ลิงก์ภาพกิจกรรม</label>
                <input type="url" class="form-control" id="activity_image" name="activity_image" required>
            </div>

            <div class="mb-3">
                <label for="activity_date" class="form-label">วันที่กิจกรรม</label>
                <input type="date" class="form-control" id="activity_date" name="activity_date" required>
            </div>

            <button type="submit" class="btn btn-success">เพิ่มกิจกรรม</button>
        </form>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>