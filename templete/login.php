<?php
session_start();

// ถ้า login แล้วให้ redirect ไปหน้า main
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //เอาข้อมูลมาจากdata base
    require_once 'includes/db.php';

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

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

            // redirect กลับหน้าที่ต้องการ หรือ index
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
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #dce8f5;
            --surface: #ffffff;
            --primary: #2d5fa6;
            --primary-light: #c8ddf0;
            --primary-hover: #1e4a8a;
            --text: #2c3e5a;
            --text-soft: #6b87a8;
            --error: #e05555;
            --input-bg: #d6e8f7;
            --radius: 22px;
        }

        body {
            font-family: 'Sarabun', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 44px 40px 40px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 8px 40px rgba(45, 95, 166, 0.14), 0 0 0 1.5px rgba(91,155,213,0.25);
            animation: fadeUp 0.35s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* LOGO */
        .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            margin-bottom: 32px;
        }

        .logo-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-light);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .logo-text {
            font-family: 'Prompt', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: 2px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-soft);
            margin-bottom: 7px;
            letter-spacing: 0.3px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            background: var(--input-bg);
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 12px 16px;
            font-family: 'Sarabun', sans-serif;
            font-size: 15px;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--primary);
            background: #eaf3fc;
        }

        input.is-error {
            border-color: var(--error) !important;
        }

        /* PASSWORD WRAPPER */
        .pw-wrap {
            position: relative;
        }

        .pw-wrap input { padding-right: 44px; }

        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-soft);
            padding: 4px;
            transition: color 0.2s;
        }

        .toggle-pw:hover { color: var(--primary); }

        /* ERROR ALERT */
        .alert-error {
            background: #fdecea;
            border: 1.5px solid #f5c6c6;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13.5px;
            color: var(--error);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* SUBMIT BUTTON */
        .btn-submit {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 13px;
            font-family: 'Sarabun', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(45,95,166,0.25);
            letter-spacing: 0.5px;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 22px rgba(45,95,166,0.32);
        }

        .btn-submit:active { transform: translateY(0); }

        /* LOADING STATE */
        .btn-submit.loading {
            opacity: 0.75;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* REGISTER LINK */
        .register-hint {
            text-align: center;
            margin-top: 22px;
            font-size: 14px;
            color: var(--text-soft);
        }

        .register-hint a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .register-hint a:hover { text-decoration: underline; }

        /* DIVIDER */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: var(--text-soft);
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--primary-light);
        }
    </style>
</head>
<body>

<div class="card">

    <!-- LOGO -->
    <div class="logo">
        <div class="logo-icon">⛺</div>
        <div class="logo-text">FAST CAMP</div>
    </div>

    <!-- ERROR -->
     <!-- ถ้าไม่กรอกอะไรหรือเกิด error จะเกิดกรอบสีแดงๆที่กล่อง input-->
    <?php if ($error): ?>
    <div class="alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <!-- FORM -->
    <form method="POST" action="" id="loginForm" novalidate>

        <div class="form-group">
            <label for="email">e-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                autocomplete="email"
                placeholder="example@email.com"
                <?= $error ? 'class="is-error"' : '' ?>
            >
        </div>

        <div class="form-group">
            <label for="password">password</label>
            <div class="pw-wrap">
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    placeholder="อย่างน้อย 8 ตัว"
                    <?= $error ? 'class="is-error"' : '' ?>
                >
                <!-- ปุ่มซ่อนแสดง รหัสผ่าน -->
                <button type="button" class="toggle-pw" onclick="togglePassword()" title="แสดง/ซ่อนรหัสผ่าน">
                    <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg> 
                </button> 
            </div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">เข้าสู่ระบบ</button>
    </form>

    <div class="register-hint">
        ยังไม่มีบัญชี? <a href="register.php">ลงทะเบียน</a>
    </div>

</div>

<script>
    // Toggle show/hide password
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
                <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
            `;
        }
    }

    // Client-side validation
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value.trim();
        const pw    = document.getElementById('password').value;
        const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        document.getElementById('email').classList.remove('is-error');
        document.getElementById('password').classList.remove('is-error');

        if (!email || !emailReg.test(email)) {
            document.getElementById('email').classList.add('is-error');
            document.getElementById('email').focus();
            e.preventDefault(); return;
        }
        if (!pw) {
            document.getElementById('password').classList.add('is-error');
            document.getElementById('password').focus();
            e.preventDefault(); return;
        }

        // Loading state
        const btn = document.getElementById('submitBtn');
        btn.textContent = 'กำลังเข้าสู่ระบบ...';
        btn.classList.add('loading');
    });
</script>

</body>
</html>