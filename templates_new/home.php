<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAST CAMP-หน้าหลัก</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Kanit', 'sans-serif'] },
                    colors: {
                        primary: '#1c3671',
                        secondary: '#c8defa',
                        surface: '#e3efff',
                        bg_main: '#f2f6fc',
                        accent: '#e93b81'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bg_main font-sans text-primary min-h-screen flex-col">
    <nav class="bg-bg_main py-4 px-8 flex justify-between items-center sticky top-0 z-50">
        <!-- logo -->
        <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='/home'">
            <div class="bg-white text-white w-10 h-10 rounded-lg flex items-center justify-center text-xl shadow-md">
                <img src="logo.png" alt="" class="h-12 w-auto">
            </div>
            <h1 class="text-2xl font-bold tracking-wide">FAST CAMP</h1>
        </div>
        <!-- menu -->
        <div class="'hidden md:flex hg-white rounded-full shadow-sm px-6 py-2 gaap-8 items-center">
            <a href="/home">CAMP-หน้าหลัก</a>
            <a href="/my-activities">กิจกรรมของฉัน</a>
            <a href="/create">สร้างกิจกรรม</a>
            <a href="/profile">โปรไฟล์</a>
        </div>
        <!-- log-in/profile -->
        <div onclick="window.locatiob.href='/profile'">

        </div>
    </nav>
</body>
</html> 