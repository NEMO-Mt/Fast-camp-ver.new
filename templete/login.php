<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'includes/db.php';

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // เช็กข้อมูลด้วย PHP (จำเป็นมากเมื่อไม่มี JS)
    if (empty($email) || empty($password)) {
        $error = 'กรุณากรอกอีเมลและรหัสผ่าน';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'รูปแบบอีเมลไม่ถูกต้อง';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");       
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            $redirect = $_SESSION['redirect_after_login'] ?? 'index.php';
            unset($_SESSION['redirect_after_login']);
            header('Location: ' . $redirect);
            exit();
        } else {
            $error = 'อีเมลหรือรหัสผ่านไม่ถูกต้อง';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ — Fast Camp</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&family=Prompt:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS ส่วนใหญ่คงเดิม แต่ปรับแก้จุดที่เคยมีปุ่มดวงตา */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #dce8f5; --surface: #ffffff; --primary: #2d5fa6;
            --primary-light: #c8ddf0; --primary-hover: #1e4a8a;
            --text: #2c3e5a; --text-soft: #6b87a8; --error: #e05555;
            --input-bg: #d6e8f7; --radius: 22px;
        }
        body { font-family: 'Sarabun', sans-serif; background: var(--bg); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card { background: var(--surface); border-radius: var(--radius); padding: 44px 40px 40px; width: 100%; max-width: 380px; box-shadow: 0 8px 40px rgba(45, 95, 166, 0.14); animation: fadeUp 0.35s ease; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        .logo { display: flex; flex-direction: column; align-items: center; gap: 6px; margin-bottom: 32px; }
        .logo-icon { width: 64px; height: 64px; background: var(--primary-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 30px; }
        .logo-text { font-family: 'Prompt', sans-serif; font-size: 15px; font-weight: 700; color: var(--text); letter-spacing: 2px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 500; color: var(--text-soft); margin-bottom: 7px; }
        input[type="email"], input[type="password"] {
            width: 100%; background: var(--input-bg); border: 2px solid transparent; border-radius: 10px;
            padding: 12px 16px; font-family: 'Sarabun', sans-serif; font-size: 15px; color: var(--text); outline: none; transition: 0.2s;
        }
        input:focus { border-color: var(--primary); background: #eaf3fc; }
        input.is-error { border-color: var(--error) !important; }
        .alert-error { background: #fdecea; border: 1.5px solid #f5c6c6; border-radius: 10px; padding: 11px 14px; font-size: 13.5px; color: var(--error); margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
        .btn-submit { width: 100%; background: var(--primary); color: white; border: none; border-radius: 50px; padding: 13px; font-size: 16px; font-weight: 700; cursor: pointer; margin-top: 8px; box-shadow: 0 4px 16px rgba(45,95,166,0.25); }
        .btn-submit:hover { background: var(--primary-hover); transform: translateY(-1px); }
        .register-hint { text-align: center; margin-top: 22px; font-size: 14px; color: var(--text-soft); }
        .register-hint a { color: var(--primary); font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <div class="logo">
        <div class="logo-icon">⛺</div>
        <div class="logo-text">FAST CAMP</div>
    </div>

    <?php if ($error): ?>
    <div class="alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="" id="loginForm">
        <div class="form-group">
            <label for="email">e-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                placeholder="example@email.com"
                required
                <?= $error ? 'class="is-error"' : '' ?>
            >
        </div>

        <div class="form-group">
            <label for="password">password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="อย่างน้อย 8 ตัว"
                required
                <?= $error ? 'class="is-error"' : '' ?>
            >
        </div>

        <button type="submit" class="btn-submit">เข้าสู่ระบบ</button>
    </form>

    <div class="register-hint">
        ยังไม่มีบัญชี? <a href="register.php">ลงทะเบียน</a>
    </div>
</div>

</body>
</html>