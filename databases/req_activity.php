<?php
function getApprovedReq_activity($id)
{
    $conn = getConnection();
    $query = "SELECT approvals.*, activity.*, userss.*
             FROM approvals
             JOIN activity ON approvals.aid = activity.aid
             JOIN userss ON approvals.rid = userss.id
             WHERE activity.organizer_id = ? AND approval_status = 'approved'";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

function getRejectedReq_activity($id)
{
    $conn = getConnection();
    $query = "SELECT approvals.*, activity.*, userss.*
             FROM approvals
             JOIN activity ON approvals.aid = activity.aid
             JOIN userss ON approvals.rid = userss.id
             WHERE activity.organizer_id = ? AND approval_status = 'rejected'";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}


function getAllReq_activity($id)
{
    $conn = getConnection();

    // เขียนคำสั่ง SQL เพื่อดึงข้อมูลทั้งหมดจากตาราง approvals
    $query = "SELECT approvals.*, activity.*, userss.* 
          FROM approvals
          JOIN activity ON approvals.aid = activity.aid
          JOIN userss ON approvals.rid = userss.id
          WHERE activity.organizer_id = ? AND approval_status = 'pending'";



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


function approveUser($ap_id)
{
    // เชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

    // เขียนคำสั่ง SQL เพื่อดึงข้อมูลทั้งหมดจากตาราง approvals
    $query = "UPDATE approvals 
              SET approval_status = 'approved' 
              WHERE ap_id = ?";


    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ap_id);

    // ดำเนินการคำสั่ง SQL
    $stmt->execute();
    $result = $stmt->get_result();

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();

    // คืนค่าผลลัพธ์
    return $result;
}



function rejectUser($ap_id)
{
    // เชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

    // เขียนคำสั่ง SQL เพื่อดึงข้อมูลทั้งหมดจากตาราง approvals
    $query = "UPDATE approvals 
              SET approval_status = 'rejected' 
              WHERE ap_id = ?";


    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ap_id);

    // ดำเนินการคำสั่ง SQL
    $stmt->execute();
    $result = $stmt->get_result();

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();

    // คืนค่าผลลัพธ์
    return $result;
}
