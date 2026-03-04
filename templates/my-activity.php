<?php
session_start();
require_once 'includes/db.php'; // ไฟล์เชื่อมต่อ DB ของคุณ

// ดึงข้อมูลกิจกรรมทั้งหมด
$stmt = $pdo->query("SELECT * FROM activities ORDER BY created_at DESC");
$activities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>กิจกรรมของฉัน — FAST CAMP</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&family=Prompt:wght@600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #eaf3fc; --surface: #ffffff; --primary: #2d5fa6;
            --card-blue: #c8ddf0; --text: #2c3e5a;
        }
        body { font-family: 'Sarabun', sans-serif; background: var(--bg); margin: 0; padding: 20px; }
        
        /* Navbar Simple */
        .navbar { display: flex; justify-content: center; gap: 30px; margin-bottom: 40px; padding: 20px; }
        .navbar a { text-decoration: none; color: var(--text); font-weight: 500; }
        .navbar a.active { border-bottom: 2px solid var(--primary); color: var(--primary); }

        .title-badge { 
            background: var(--card-blue); color: var(--primary);
            padding: 10px 40px; border-radius: 50px; width: fit-content;
            margin: 0 auto 40px; font-family: 'Prompt'; font-size: 24px;
        }

        .activity-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px; max-width: 1000px; margin: 0 auto;
        }

        /* Activity Card */
        .card { 
            background: var(--surface); border-radius: 20px; overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #d1e3f5;
        }
        .card-img { height: 150px; background: var(--card-blue); display: flex; align-items: center; justify-content: center; }
        .card-body { padding: 15px; }
        .card-title { font-weight: 700; color: var(--primary); margin-bottom: 5px; font-size: 16px; }
        .card-desc { font-size: 12px; color: #6b87a8; line-height: 1.4; height: 34px; overflow: hidden; }
        
        .status-box { 
            display: flex; justify-content: space-between; font-size: 10px; margin: 10px 0;
            background: #f0f7ff; padding: 5px; border-radius: 5px;
        }

        /* Add Button Card */
        .add-card {
            border: 2px dashed #b8cedf; background: none; cursor: pointer;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            min-height: 300px; border-radius: 20px; transition: 0.3s; color: var(--primary);
        }
        .add-card:hover { background: #ffffff; border-color: var(--primary); }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="#">หน้าหลัก</a>
        <a href="#" class="active">กิจกรรมของฉัน</a>
        <a href="#">การลงทะเบียน</a>
        <a href="#">โปรไฟล์</a>
    </div>

    <div class="title-badge">กิจกรรมของฉัน</div>

    <div class="activity-grid">
        <?php foreach ($activities as $row): ?>
        <div class="card">
            <div class="card-img">
                <?php if($row['image_path']): ?>
                    <img src="uploads/<?= $row['image_path'] ?>" style="width:100%; height:100%; object-fit:cover;">
                <?php else: ?>
                    🖼️
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="card-title"><?= htmlspecialchars($row['title']) ?></div>
                <div class="card-desc"><?= htmlspecialchars($row['description']) ?></div>
                <div class="status-box">
                    <span style="color:green;">อนุมัติ : <?= $row['status_joined'] ?>/150</span>
                    <span style="color:red;">รออนุมัติ : 0/150</span>
                </div>
                <div style="display:flex; gap:5px;">
                    <button style="flex:1; background:var(--card-blue); border:none; border-radius:5px; color:var(--primary); padding:5px;">จัดการ</button>
                    <button style="background:#6ea8fe; border:none; border-radius:5px; color:white; padding:5px;">✏️</button>
                    <button style="background:#6ea8fe; border:none; border-radius:5px; color:white; padding:5px;">🗑️</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <a href="add-activity.php" style="text-decoration:none;">
            <div class="add-card">
                <span style="font-size: 50px;">+</span>
                <p>เพิ่มกิจกรรมใหม่</p>
            </div>
        </a>
    </div>

</body>
</html>