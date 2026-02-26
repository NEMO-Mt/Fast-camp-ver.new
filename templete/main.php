<?php
session_start();
require_once 'includes/db.php'; // เชื่อมต่อฐานข้อมูลจริง

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';

// รับค่าค้นหาจาก URL (ถ้ามี)
$search = trim($_GET['search'] ?? '');
$date_start = $_GET['date_start'] ?? '';

// สร้าง SQL พื้นฐาน
$sql = "SELECT * FROM activities WHERE 1=1";
$params = [];

// ถ้ามีการกรอกช่องค้นหา
if (!empty($search)) {
    $sql .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// ถ้ามีการเลือกวันที่ (สมมติว่าใน DB มีคอลัมน์ start_date)
if (!empty($date_start)) {
    $sql .= " AND start_date >= ?";
    $params[] = $date_start;
}

$sql .= " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Camp</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&family=Prompt:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #dce8f5;
            --surface: #ffffff;
            --card-bg: #c8ddf0;
            --primary: #5b9bd5;
            --primary-dark: #3a7bbf;
            --text: #2c3e5a;
            --text-soft: #6b87a8;
            --tag-bg: #e8f2fc;
            --tag-color: #3a7bbf;
            --shadow: 0 4px 20px rgba(91,155,213,0.12);
            --shadow-hover: 0 8px 32px rgba(91,155,213,0.22);
            --radius: 18px;
        }

        body {
            font-family: 'Sarabun', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ===== NAVBAR ===== */
        nav {
            background: var(--surface);
            padding: 0 48px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(91,155,213,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            width: 52px;
            height: 52px;
            background: var(--card-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .logo-text {
            font-family: 'Prompt', sans-serif;
            font-weight: 700;
            font-size: 15px;
            color: var(--text);
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .logo-text span { display: block; font-size: 11px; font-weight: 400; color: var(--text-soft); letter-spacing: 2px; }

        .nav-links {
            display: flex;
            gap: 40px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-soft);
            font-size: 15px;
            font-weight: 500;
            padding-bottom: 4px;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
        }

        .nav-links a:hover { color: var(--primary); border-bottom-color: var(--primary); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-login {
            background: var(--card-bg);
            color: var(--text);
            border: none;
            padding: 10px 22px;
            border-radius: 50px;
            font-family: 'Sarabun', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-login:hover { background: var(--primary); color: white; transform: translateY(-1px); }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
        }

        .user-greeting {
            font-size: 14px;
            color: var(--text-soft);
            font-weight: 500;
        }

        /* ===== MAIN ===== */
        main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        /* ===== SEARCH BOX ===== */
        .search-section {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 20px 24px;
            box-shadow: var(--shadow);
            margin-bottom: 48px;
        }

        .search-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .search-icon { color: var(--text-soft); font-size: 18px; cursor: pointer; }

        .search-input {
            flex: 1;
            border: none;
            outline: none;
            font-family: 'Sarabun', sans-serif;
            font-size: 15px;
            color: var(--text);
            background: transparent;
        }

        .search-input::placeholder { color: var(--text-soft); }

        .search-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-soft);
            font-size: 18px;
            transition: color 0.2s;
        }

        .search-btn:hover { color: var(--primary); }

        .date-row {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .date-field {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-soft);
        }

        .date-field input[type="date"] {
            border: 1.5px solid #c8ddf0;
            border-radius: 8px;
            padding: 6px 12px;
            font-family: 'Sarabun', sans-serif;
            font-size: 13px;
            color: var(--text);
            background: var(--bg);
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .date-field input[type="date"]:focus { border-color: var(--primary); }

        /* ===== SECTION TITLE ===== */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .section-title {
            font-family: 'Prompt', sans-serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--text);
        }

        .view-all {
            font-size: 14px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        /* ===== CARDS ===== */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 900px) { .cards-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 500px) { .cards-grid { grid-template-columns: 1fr; } }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.25s, box-shadow 0.25s;
            display: flex;
            flex-direction: column;
        }

        .card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }

        .card-image {
            width: 100%;
            aspect-ratio: 4/3;
            background: #b0cee8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8ab0cc;
            font-size: 40px;
        }

        .card-body {
            padding: 14px 14px 16px;
            background: var(--card-bg);
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .card-tag {
            display: inline-block;
            background: #e8f2fc;
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            width: fit-content;
        }

        .card-title {
            font-family: 'Prompt', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            line-height: 1.4;
        }

        .card-desc {
            font-size: 12px;
            color: var(--text-soft);
            line-height: 1.6;
            flex: 1;
        }

        .card-location {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: var(--text-soft);
            margin-top: 4px;
        }

        .card-location svg { flex-shrink: 0; }

        .btn-detail {
            display: block;
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-family: 'Sarabun', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            margin-top: 10px;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-detail:hover { background: var(--primary-dark); transform: translateY(-1px); }

        /* ===== MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(44, 62, 90, 0.45);
            backdrop-filter: blur(4px);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active { display: flex; }

        .modal {
            background: white;
            border-radius: 24px;
            padding: 40px 36px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(44,62,90,0.2);
            animation: modalIn 0.25s ease;
        }

        @keyframes modalIn {
            from { transform: scale(0.92) translateY(12px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }

        .modal-icon { font-size: 48px; margin-bottom: 16px; }
        .modal h2 { font-family: 'Prompt', sans-serif; font-size: 20px; color: var(--text); margin-bottom: 8px; }
        .modal p { font-size: 15px; color: var(--text-soft); margin-bottom: 28px; line-height: 1.6; }

        .modal-buttons { display: flex; gap: 12px; }

        .btn-modal-login {
            flex: 1;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-family: 'Sarabun', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: block;
            transition: background 0.2s;
        }

        .btn-modal-login:hover { background: var(--primary-dark); }

        .btn-modal-cancel {
            flex: 1;
            background: var(--bg);
            color: var(--text-soft);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-family: 'Sarabun', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-modal-cancel:hover { background: var(--card-bg); }

        /* divider */
        .search-divider {
            height: 1px;
            background: var(--bg);
            margin-bottom: 16px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a href="index.php" class="logo">
        <div class="logo-icon">⛺</div>
        <div class="logo-text">
            FAST CAMP
            <span>ACTIVITIES</span>
        </div>
    </a>

    <ul class="nav-links">
        <li>
            <a href="<?= $isLoggedIn ? 'my-activities.php' : '#' ?>"
               <?= !$isLoggedIn ? 'onclick="showModal(); return false;"' : '' ?>>
                กิจกรรมของฉัน
            </a>
        </li>
        <li>
            <a href="<?= $isLoggedIn ? 'register-activity.php' : '#' ?>"
               <?= !$isLoggedIn ? 'onclick="showModal(); return false;"' : '' ?>>
                การลงทะเบียน
            </a>
        </li>
        <li>
            <a href="<?= $isLoggedIn ? 'profile.php' : '#' ?>"
               <?= !$isLoggedIn ? 'onclick="showModal(); return false;"' : '' ?>>
                โปรไฟล์
            </a>
        </li>
    </ul>

    <div class="nav-right">
        <?php if ($isLoggedIn): ?>
            <span class="user-greeting">สวัสดี, <?= htmlspecialchars($userName) ?></span>
            <div class="avatar"><?= mb_substr($userName, 0, 1) ?></div>
            <a href="logout.php" class="btn-login">ออกจากระบบ</a>
        <?php else: ?>
            <a href="login.php" class="btn-login">
                เข้าสู่ระบบ
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </a>
        <?php endif; ?>
    </div>
</nav>

<!-- MAIN -->
<main>

    <!-- SEARCH -->
<form action="index.php" method="GET" class="search-section">
    <div class="search-row">
        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="6" y2="12"/><line x1="3" y1="6" x2="6" y2="6"/><line x1="3" y1="18" x2="6" y2="18"/><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/></svg>
        
        <input type="text" name="search" class="search-input" 
               placeholder="ค้นหากิจกรรม" 
               value="<?= htmlspecialchars($search) ?>">
        
        <button type="submit" class="search-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
    </div>
    
    <div class="search-divider"></div>
    
    <div class="date-row">
        <div class="date-field">
            <span>วันที่เริ่มกิจกรรม :</span>
            <input type="date" name="date_start" value="<?= htmlspecialchars($date_start) ?>">
        </div>
        <?php if(!empty($search) || !empty($date_start)): ?>
            <a href="index.php" style="font-size: 12px; color: var(--text-soft); text-decoration: none;">✕ ล้างการค้นหา</a>
        <?php endif; ?>
    </div>
</form>

    <!-- ACTIVITY CARDS -->
    <div class="section-header">
        <h2 class="section-title">กิจกรรมทั้งหมด</h2>
        <a href="#" class="view-all">ดูทั้งหมด →</a>
    </div>

    <div class="cards-grid">
        <?php foreach ($activities as $act): ?>
        <div class="card">
            <div class="card-image">
                <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
            </div>
            <div class="card-body">
                <span class="card-tag"><?= $act['tag'] ?></span>
                <div class="card-title"><?= $act['title'] ?></div>
                <div class="card-desc"><?= $act['desc'] ?></div>
                <div class="card-location">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    <?= $act['location'] ?>
                </div>
                <?php if ($isLoggedIn): ?>
                    <a href="activity-detail.php?id=<?= $act['id'] ?>" class="btn-detail">รายละเอียด</a>
                <?php else: ?>
                    <button class="btn-detail" onclick="showModal()">รายละเอียด</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</main>

<!-- MODAL: กรุณาเข้าสู่ระบบ -->
<div class="modal-overlay" id="loginModal" onclick="hideModal(event)">
    <div class="modal">
        <div class="modal-icon">🔐</div>
        <h2>กรุณาเข้าสู่ระบบก่อน</h2>
        <p>คุณต้องเข้าสู่ระบบก่อนจึงจะสามารถ<br>ใช้งานฟีเจอร์นี้ได้</p>
        <div class="modal-buttons">
            <button class="btn-modal-cancel" onclick="hideModal()">ยกเลิก</button>
            <a href="login.php" class="btn-modal-login">เข้าสู่ระบบ</a>
        </div>
    </div>
</div>

<script>
    function showModal() {
        document.getElementById('loginModal').classList.add('active');
    }
    function hideModal(e) {
        if (!e || e.target === document.getElementById('loginModal')) {
            document.getElementById('loginModal').classList.remove('active');
        }
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') hideModal();
    });
</script>

</body>
</html>