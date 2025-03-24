<?php
function insertApprovalData($aid, $rid, $approval_by, $approval_status, $approval_date) {
    $conn = getConnection();

    // ตรวจสอบว่าข้อมูลซ้ำหรือไม่
    $checkQuery = "SELECT COUNT(*) FROM approvals WHERE aid = ? AND rid = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ii", $aid, $rid);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->store_result(); // เพิ่ม store_result() เพื่อดึงข้อมูลให้เสร็จสมบูรณ์
    $stmt->fetch();
    $stmt->close(); // ปิด $stmt หลังจากใช้งานเสร็จ

    // ตรวจสอบว่า approval_by มีค่า หากไม่มีให้ใช้ค่าเริ่มต้นจาก session หรือค่าที่คุณต้องการ
    $approval_by = $approval_by ?? $_SESSION['first_name'] ?? 'default_approval_id';

    if ($count == 0) {
        // เตรียมคำสั่ง INSERT ใหม่
        $insertQuery = "INSERT INTO approvals (aid, rid, approval_by, approval_status, approval_date) 
                        VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iisss", $aid, $rid, $approval_by, $approval_status, $approval_date);

        if ($stmt->execute()) {
            echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $stmt->error;
        }
        $stmt->close(); // ปิด $stmt หลังใช้งานเสร็จ
    } else {
        echo "ข้อมูลซ้ำในฐานข้อมูล";
    }
}


function getApprovalStatus($aid) {
    $conn = getConnection();

    $query = "SELECT approval_status FROM approvals WHERE aid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $stmt->bind_result($approval_status);
    $stmt->fetch();
    $stmt->close(); // ปิด $stmt หลังใช้งานเสร็จ

    return $approval_status;
}



function getAllApprovaldata($id) {
    // เชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

    // เขียนคำสั่ง SQL เพื่อดึงข้อมูลทั้งหมดจากตาราง approvals
    $query = "SELECT * FROM approvals where rid = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    // ดำเนินการคำสั่ง SQL
    $stmt->execute();
    $result = $stmt->get_result();

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();

    // คืนค่าผลลัพธ์
    return $result;
}


function getUserActivities($userId) {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

    // สร้าง SQL query ดึงข้อมูลกิจกรรมที่ผู้ใช้เข้าร่วม (ไม่รวม creator)
    $query = "
        SELECT a.aid, a.title, a.description, a.start_date, a.end_date, a.image
        FROM activity a
        JOIN approvals ap ON a.aid = ap.aid
        WHERE ap.rid = ?
    ";

    // เตรียม statement
    $stmt = $conn->prepare($query);

    // ผูกค่าของ userId ไปที่ ?
    $stmt->bind_param("i", $userId);

    // Execute query
    $stmt->execute();

    // รับผลลัพธ์
    $result = $stmt->get_result();

    // สร้างอาร์เรย์เพื่อเก็บผลลัพธ์
    $activities = [];

    while ($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }

    // ปิด statement
    $stmt->close();

    // ส่งกลับผลลัพธ์เป็นอาร์เรย์ของกิจกรรม
    return $activities;
}



function getCreatorActivities($userId) {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

    $query = "
        SELECT a.aid, a.title, a.description, a.start_date, a.end_date, a.image
        FROM activity a
        JOIN approvals ap ON a.aid = ap.aid
        WHERE ap.rid = ? AND ap.approval_status = 'Creator'
    ";

    // เตรียม statement
    $stmt = $conn->prepare($query);

    // ผูกค่าของ userId ไปที่ ?
    $stmt->bind_param("i", $userId);

    // Execute query
    $stmt->execute();

    // รับผลลัพธ์
    $result = $stmt->get_result();

    // สร้างอาร์เรย์เพื่อเก็บผลลัพธ์
    $activities = [];

    while ($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }

    // ปิด statement
    $stmt->close();

    // ส่งกลับผลลัพธ์เป็นอาร์เรย์ของกิจกรรม
    return $activities;
}


function getRequestsBypedding($uid) {
    $conn = getConnection();

    // เพิ่มเงื่อนไขกรองสถานะ 'pending'
    $sql = "SELECT join_request.aid, join_request.uid, activity.a_title, userse.u_name, userse.u_email, join_request.r_status, join_request.r_date
            FROM join_request
            JOIN activity ON join_request.aid = activity.aid
            JOIN userse ON join_request.uid = userse.uid
            WHERE activity.aid IN (
                SELECT aid FROM creater WHERE uid = ?
            )
            AND join_request.r_status = 'pending'";  // กรองเฉพาะคำขอที่ยังไม่อนุมัติ

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("SQL Error: " . $conn->error);  // ตรวจสอบการเตรียมคำสั่ง
    }

    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

?>


