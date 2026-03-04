<!DOCTYPE html>
<html lang="th">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-4 md:p-7 font-sans">
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
    <div class="max-w-5xl mx-auto bg-white rounded-3xl p-8 shadow-lg">
        
    
        <div class="w-full h-64 bg-gray-200 rounded-3xl flex items-center justify-center text-gray-400 mb-8">
            รูปกิจกรรม
        </div>

        <h1 class="text-3xl font-bold text-blue-900 text-center mb-8">ค่ายเขียนโปรแกรมพื้นฐาน</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-4 text-gray-700">
                <div class="bg-blue-50 p-3 rounded-lg">📅 21/02/2569 - 28/02/2569</div>
                <div class="flex items-center gap-2">👤 จัดทำโดย <b>มาม่า สมดี</b></div>
                <div class="flex items-center gap-2">📍 คณะ IT-MSU</div>
                <div class="flex items-center gap-2">👥 0/150 คน</div>
            </div>

            <div class="md:col-span-1">
                <h3 class="font-bold text-blue-900 mb-2">รายละเอียด</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    พื้นฐานสำคัญสำหรับนักพัฒนาหน้าใหม่ เรียนรู้ง่าย สนุกได้ความรู้ ได้ความรู้มากมายจากวิทยากรจากหลากหลายมหาลัย ค่ายเหมาะกับน้องๆ ม.ปลาย ที่สนใจด้านไอที
                </p>
            </div>

            <div>
                <h3 class="font-bold text-blue-900 mb-2">รูปภาพเพิ่มเติม</h3>
                <div class="grid grid-cols-3 gap-2">
                    <div class="w-full aspect-square bg-gray-200 rounded"></div>
                    <div class="w-full aspect-square bg-gray-200 rounded"></div>
                    <div class="w-full aspect-square bg-gray-200 rounded"></div>
                    <div class="w-full aspect-square bg-gray-200 rounded"></div>
                    <div class="w-full aspect-square bg-gray-200 rounded"></div>
                    <div class="w-full aspect-square bg-gray-200 rounded"></div>
                </div>
            </div>
        </div>

        <div class="text-center mt-10">
            <button class="bg-blue-200 hover:bg-blue-300 text-blue-900 font-bold py-3 px-10 rounded-2xl transition">
                + เข้าร่วมกิจกรรม
            </button>
        </div>
    </div>

</body>
</html>