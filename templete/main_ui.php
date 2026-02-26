<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAST CAMP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* กำหนดฟอนต์ให้ดูสะอาดตา */
        body { font-family: 'Kanit', sans-serif; }
    </style>
</head>
<body class="bg-[#f0f7ff]">

    < <header class="max-w-6xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-6">
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

    <div class="max-w-4xl mx-auto bg-[#dbeafe] p-8 rounded-[40px] shadow-inner border border-blue-100 flex gap-6 items-center">
        <input type="text" placeholder="🔍 ค้นหากิจกรรม" class="flex-1 p-4 rounded-2xl outline-none shadow-sm">
        <div class="flex items-center gap-2 text-sm text-[#1e3a8a] font-bold">
            วันที่เริ่มกิจกรรม: <input type="date" class="p-3 rounded-xl outline-none shadow-sm">
        </div>
        <div class="flex items-center gap-2 text-sm text-[#1e3a8a] font-bold">
            วันที่สิ้นสุดกิจกรรม: <input type="date" class="p-3 rounded-xl outline-none shadow-sm">
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-16 grid grid-cols-1 md:grid-cols-4 gap-8 px-10">
        <?php
        $events = array_fill(0, 4, ["name" => "ค่ายเขียนโปรแกรมพื้นฐาน"]);
        foreach ($events as $event) {
            echo '
            <div class="bg-white rounded-[30px] p-6 shadow-xl border border-gray-50 flex flex-col items-center text-center">
                <div class="w-full h-40 bg-[#c6e1ff] rounded-3xl mb-5"></div>
                <div class="self-start bg-blue-100 text-[#1e3a8a] text-xs font-bold px-3 py-1 rounded-lg mb-3">ไอที</div>
                <h3 class="font-bold text-[#1e3a8a] text-lg mb-2">' . $event['name'] . '</h3>
                <p class="text-sm text-gray-500 mb-6">พื้นฐานสำหรับนักพัฒนารุ่นใหม่ เรียนรู้ง่าย สนุกได้ความรู้</p>
                <div class="text-xs text-gray-600 mb-4 flex items-center gap-1">📍 คณะ IT-MSU</div>
                <button class="w-full bg-[#c6e1ff] text-[#1e3a8a] font-bold py-3 rounded-2xl hover:bg-blue-200 transition">รายละเอียด</button>
            </div>';
        }
        ?>
    </div>

</body>
</html>