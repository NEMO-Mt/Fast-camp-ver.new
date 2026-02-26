<?php
session_start();

// 1. ถ้า login อยู่แล้ว ห้ามเข้าหน้าสมัครสมาชิก
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลจากdata base
    require_once 'includes/db.php';

    // รับค่าจากฟอร์ม
    $name       = trim($_POST['name'] ?? '');
    $occupation = trim($_POST['occupation'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $birthdate  = $_POST['birthdate'] ?? '';
    $gender     = $_POST['gender'] ?? '';
    $password   = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // 2. ตรวจสอบความถูกต้อง (Validation)
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'กรุณากรอกข้อมูลในช่องที่จำเป็นให้ครบถ้วน';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'รูปแบบอีเมลไม่ถูกต้อง';
    } elseif ($password !== $confirm_password) {
        $error = 'รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน';
    } elseif (strlen($password) < 8) {
        $error = 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร';
    } else {
        // 3. ตรวจสอบว่าอีเมลนี้ถูกใช้ไปหรือยัง
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'อีเมลนี้ถูกใช้งานไปแล้ว';
        } else {
            // 4. เข้ารหัสลับรหัสผ่าน (Hashing) - สำคัญมาก!
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // 5. บันทึกข้อมูลลงฐานข้อมูล
            $sql = "INSERT INTO users (name, occupation, email, phone, birthdate, gender, password) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            try {
                $stmt->execute([$name, $occupation, $email, $phone, $birthdate, $gender, $hashed_password]);
                $success = 'สมัครสมาชิกสำเร็จ! กำลังพากันไปหน้าเข้าสู่ระบบ...';
                // Redirect ไปหน้า login หลังจาก 2 วินาที
                header("refresh:2;url=login.php");
            } catch (PDOException $e) {
                $error = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก — Fast Camp</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&family=Prompt:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ใช้แนวทาง CSS เดียวกับหน้า Login ของคุณ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #dce8f5; --surface: #ffffff; --primary: #2d5fa6;
            --primary-light: #c8ddf0; --text: #2c3e5a;
            --text-soft: #6b87a8; --error: #e05555;
            --success: #4caf50; --input-bg: #d6e8f7; --radius: 30px;
        }
        body { font-family: 'Sarabun', sans-serif; background: var(--bg); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        
        .card { 
            background: var(--surface); border-radius: var(--radius); 
            padding: 40px; width: 100%; max-width: 800px; /* ขยายกว้างขึ้นเพื่อให้วาง 2 คอลัมน์ได้เหมือนรูป */
            box-shadow: 0 10px 50px rgba(45, 95, 166, 0.15); 
        }

        .logo { display: flex; flex-direction: column; align-items: center; gap: 6px; margin-bottom: 30px; }
        .logo-icon { width: 60px; height: 60px; background: var(--primary-light); border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 28px; }
        .logo-text { font-family: 'Prompt', sans-serif; font-size: 18px; font-weight: 700; color: var(--text); letter-spacing: 2px; }

        /* การจัดวางแบบ 2 คอลัมน์ */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 13px; font-weight: 600; color: var(--primary); margin-bottom: 5px; margin-left: 5px; }
        
        input, select {
            width: 100%; background: var(--input-bg); border: 2px solid transparent; 
            border-radius: 12px; padding: 12px 16px; font-size: 15px; outline: none; transition: 0.2s;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        }
        input:focus { border-color: var(--primary); background: #ffffff; }

        .btn-register {
            grid-column: span 2; /* ปุ่มยาวเต็มความกว้าง */
            background: #214d80; color: white; border: none; border-radius: 10px;
            padding: 14px; font-size: 16px; font-weight: 700; cursor: pointer;
            margin-top: 20px; transition: 0.3s;
        }
        .btn-register:hover { background: #1a3a61; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }

        .alert { padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; text-align: center; }
        .alert-error { background: #fdecea; color: var(--error); border: 1px solid #f5c6c6; }
        .alert-success { background: #e8f5e9; color: var(--success); border: 1px solid #c8e6c9; }

        .login-link { text-align: center; margin-top: 20px; font-size: 14px; color: var(--text-soft); }
        .login-link a { color: var(--primary); font-weight: 600; text-decoration: none; }

        /* Responsive สำหรับมือถือ */
        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .btn-register { grid-column: span 1; }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="logo">
        <div class="logo-icon">⛺</div>
        <div class="logo-text">FAST CAMP</div>
    </div>

    <?php if ($error): ?> <div class="alert alert-error"><?= $error ?></div> <?php endif; ?>
    <?php if ($success): ?> <div class="alert alert-success"><?= $success ?></div> <?php endif; ?>

    <form method="POST" action="">
        <div class="form-grid">
            <div class="form-group">
                <label>ชื่อ-นามสกุล</label>
                <input type="text" name="name" required placeholder="สมชาย ใจดี">
            </div>
            <div class="form-group">
                <label>อาชีพ</label>
                <input type="text" name="occupation" placeholder="นักเรียน / พนักงานบริษัท">
            </div>
            <div class="form-group">
                <label>อีเมล</label>
                <input type="email" name="email" required placeholder="example@email.com">
            </div>
            <div class="form-group">
                <label>เบอร์โทร</label>
                <input type="text" name="phone" placeholder="08XXXXXXXX">
            </div>
            <div class="form-group">
                <label>วันเกิด</label>
                <input type="date" name="birthdate">
            </div>
            <div class="form-group">
                <label>เพศ</label>
                <select name="gender">
                    <option value="">เลือกเพศ</option>
                    <option value="ชาย">ชาย</option>
                    <option value="หญิง">หญิง</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
            </div>
            <div class="form-group">
                <label>รหัสผ่าน</label>
                <input type="password" name="password" required placeholder="อย่างน้อย 8 ตัว">
            </div>
            <div class="form-group">
                <label>ยืนยันรหัสผ่าน</label>
                <input type="password" name="confirm_password" required placeholder="พิมพ์รหัสผ่านอีกครั้ง">
            </div>

            <button type="submit" class="btn-register">สมัครสมาชิก</button>
        </div>
    </form>

    <div class="login-link">
        มีบัญชีอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a>
    </div>
</div>

</body>
</html>