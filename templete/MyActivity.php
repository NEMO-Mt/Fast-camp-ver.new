<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรมของฉัน - FAST CAMP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap');
        body { font-family: 'Kanit', sans-serif; }
    </style>
</head>
<body class="bg-[#f0f7ff] text-[#1e3a8a]">

    <header class="max-w-6xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-3">
            <div class="bg-blue-900 p-2 rounded-xl shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div class="text-blue-900 font-extrabold text-2xl tracking-tight uppercase">Fast Camp</div>
        </div>
        
        <nav class="flex gap-8 text-slate-600 font-medium bg-white/50 backdrop-blur-sm px-8 py-3 rounded-full shadow-sm border border-white">
            <a href="#" class="hover:text-blue-600 transition-colors">หน้าหลัก</a>
            <a href="#" class="hover:text-blue-600 transition-colors">กิจกรรมของฉัน</a>
            <a href="#" class="hover:text-blue-600 transition-colors border-b-2 border-blue-600 pb-1 text-blue-600">การลงทะเบียน</a>
            <a href="#" class="hover:text-blue-600 transition-colors">โปรไฟล์</a>
        </nav>

        <div class="flex items-center gap-3 bg-blue-50 border border-blue-100 pl-4 pr-1.5 py-1.5 rounded-full shadow-sm">
            <span class="font-bold text-blue-900">โมโม่888</span>
            <div class="w-10 h-10 bg-blue-400 rounded-full border-2 border-white flex items-center justify-center overflow-hidden">
                <img src="https://i.pravatar.cc/100?u=momo" alt="user">
            </div>
        </div>
    </header>
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold bg-[#d0e4ff] inline-block px-10 py-3 rounded-full">กิจกรรมของฉัน</h1>
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-10 pb-20">
        
        <?php
        // จำลองข้อมูลกิจกรรม 2 รายการตามภาพ
        $events = [1, 2]; 
        foreach ($events as $event) {
            echo '
            <div class="bg-white rounded-[30px] p-6 shadow-xl border border-gray-100 flex flex-col items-center text-center">
                <div class="w-full h-40 bg-[#c6e1ff] rounded-3xl mb-4"></div>
                <div class="w-full text-left mb-2">
                    <h3 class="font-bold text-lg">ค่ายเขียนโปรแกรมพื้นฐาน</h3>
                    <p class="text-sm text-gray-500">พื้นฐานสำหรับนักพัฒนารุ่นใหม่ เรียนรู้ง่าย สนุกได้ความรู้</p>
                </div>
                <div class="w-full flex justify-between items-center mb-4 text-xs font-bold text-red-500">
                    <span>อนุมัติ : 0/150</span>
                    <span>รออนุมัติ : 0/150</span>
                </div>
                <div class="flex w-full gap-2">
                    <button class="flex-1 bg-[#c6e1ff] font-bold py-2 rounded-xl hover:bg-blue-200 transition">จัดการ</button>
                    <button class="bg-blue-50 text-blue-500 p-2 rounded-xl border border-blue-200 hover:bg-blue-100 transition">✏️</button>
                    <button class="bg-red-50 text-red-500 p-2 rounded-xl border border-red-200 hover:bg-red-100 transition">🗑️</button>
                </div>
            </div>';
        }
        ?>

        <div class="border-4 border-dashed border-gray-300 rounded-[30px] flex flex-col items-center justify-center p-6 text-gray-400 hover:border-blue-400 hover:text-blue-400 transition cursor-pointer">
            <span class="text-5xl font-bold mb-2">+</span>
            <span class="font-bold">เพิ่มกิจกรรมใหม่</span>
        </div>
    </div>

</body>
</html>