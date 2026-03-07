<?php

require_once INCLUDES_DIR . '/database.php';
$conn = getConnection();

// ดึงข้อมูลกิจกรรมทั้งหมด
$sql = "SELECT a.*, i.image_path 
        FROM Activities a 
        LEFT JOIN Activity_Images i ON a.activity_id = i.activity_id 
        GROUP BY a.activity_id"; 
$result = $conn->query($sql);
$camp = $result->fetch_all(MYSQLI_ASSOC);

// ประมวลผลก่อนแสดงผลหน้า
renderView('home', [
    'title' => 'Fast Camp-หน้าหลัก',
    'camps => $camps'
]);