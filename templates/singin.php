<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Camp - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#eef5ff] min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-12 rounded-[50px] shadow-[0_10px_40px_rgba(0,0,0,0.08)] w-full max-w-sm flex flex-col items-center">
        
        <div class="flex flex-col items-center mb-8">
            <img src="https://cdn-icons-png.flaticon.com/512/3061/3061376.png" alt="Logo" class="w-16 h-16 mb-2">
            <h1 class="text-xl font-bold text-[#1e3a8a] uppercase tracking-widest">FAST CAMP</h1>
        </div>

        <div class="w-full space-y-4">
            <div>
                <label class="block text-sm font-bold text-[#1e3a8a] mb-1 ml-2">e-mail</label>
                <input type="email" 
                    class="w-full px-5 py-3 rounded-2xl bg-[#d0e4ff] border-none focus:ring-2 focus:ring-blue-400 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-[#1e3a8a] mb-1 ml-2">password</label>
                <input type="password" 
                    class="w-full px-5 py-3 rounded-2xl bg-[#d0e4ff] border-none focus:ring-2 focus:ring-blue-400 outline-none transition">
            </div>

            <button class="w-full bg-[#1e3a8a] hover:bg-[#1a3375] text-white font-bold py-3 rounded-full shadow-lg transition active:scale-95 mt-6">
                เข้าสู่ระบบ
            </button>
        </div>

        <div class="mt-6 text-sm text-[#1e3a8a] font-bold">
            ยังไม่มีบัญชี? <a href="Register.php" class="underline">ลงทะเบียน</a>
        </div>
    </div>

</body>
</html>