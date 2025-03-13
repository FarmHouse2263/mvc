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
        </div>
    -->
    
    <?php $id = $_SESSION['id'] ?? ''; // ตรวจสอบว่ามีค่า session หรือไม่ พึ่งแก้ 10/3/2025 ?>
<div class="container mt-5">
    <form action="/activities" method="POST">
        <input type="hidden" name="user_id" value="<?= $id ?>">
 
        <div class="mb-3">
            <label for="title" class="form-label">ชื่อกิจกรรม</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
 
        <div class="mb-3">
            <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
 
        <div class="mb-3">
            <label class="form-label">ลิงก์ภาพกิจกรรม</label>
            <div id="image-container">
                <div class="input-group mb-2">
                    <input type="url" class="form-control" name="images[]" required>
                    <button type="button" class="btn btn-danger remove-image" style="display: none;">ลบ</button>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm" id="add-image">เพิ่มภาพ</button>
        </div>
 
        <div class="mb-3">
            <label for="start_date" class="form-label">วันที่เริ่มกิจกรรม</label>
            <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
        </div>
 
        <div class="mb-3">
            <label for="end_date" class="form-label">วันที่สิ้นสุดกิจกรรม</label>
            <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
        </div>
 
        <button type="submit" class="btn btn-success">เพิ่มกิจกรรม</button>
    </form>
</div>
 
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageContainer = document.getElementById('image-container');
        const addImageButton = document.getElementById('add-image');
        
        // เพิ่มช่องกรอกลิงก์ภาพเมื่อคลิกปุ่ม "เพิ่มภาพ"
        addImageButton.addEventListener('click', function() {
            const newImageField = document.createElement('div');
            newImageField.className = 'input-group mb-2';
            newImageField.innerHTML = `
                <input type="url" class="form-control" name="images[]" required>
                <button type="button" class="btn btn-danger remove-image">ลบ</button>
            `;
            imageContainer.appendChild(newImageField);
            
            // แสดงปุ่มลบสำหรับช่องแรกถ้ามีมากกว่า 1 ช่อง
            if (imageContainer.children.length > 1) {
                imageContainer.querySelector('.remove-image').style.display = 'block';
            }
        });
        
        // ลบช่องกรอกลิงก์ภาพเมื่อคลิกปุ่ม "ลบ"
        imageContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-image')) {
                event.target.parentElement.remove();
                
                // ซ่อนปุ่มลบสำหรับช่องแรกถ้าเหลือเพียงช่องเดียว
                if (imageContainer.children.length === 1) {
                    imageContainer.querySelector('.remove-image').style.display = 'none';
                }
            }
        });
    });
</script>
</body>
 
</html>