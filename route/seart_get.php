<?php
require_once __DIR__ . '/../databases/activities.php';
$searchTerm = $_GET['search'] ?? '';

if ($searchTerm) {
    $activities = searchActivities($searchTerm);
} else {
    $activities = getActivities();
}

function searchActivities($searchTerm)
{
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
if (count($activities) > 0) {
    foreach ($activities as $activity) {
        header("Location: /data?id=" . $activity['aid']);
        exit(); 
    }
} else {
    echo "<p>ไม่พบกิจกรรมที่ตรงกับคำค้นหา</p>";
}
