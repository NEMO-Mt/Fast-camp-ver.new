<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-6 min-h-screen font-sans">
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

    <div class="max-w-xl mx-auto bg-white rounded-[30px] p-8 shadow-sm border border-blue-100">
        
        <div class="flex flex-col items-center mb-8">
            <div class="w-32 h-32 bg-gray-300 rounded-full mb-4"></div>
            <h1 class="text-2xl font-bold text-blue-900">โมโม่ 888</h1>
            <p class="text-gray-500">momo888@gmail.com</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-blue-100 p-4 rounded-2xl text-center">
                <p class="text-blue-900 font-bold">กิจกรรมที่สร้าง</p>
                <p class="text-3xl font-bold text-blue-800">0</p>
            </div>
            <div class="bg-blue-600 p-4 rounded-2xl text-center">
                <p class="text-white font-bold">การลงทะเบียน</p>
                <p class="text-3xl font-bold text-white">0</p>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="font-bold text-blue-900 mb-4 border-b pb-2">ข้อมูลส่วนตัว</h2>
            <div class="grid grid-cols-2 gap-y-4 text-sm">
                <p class="text-gray-600">วันเกิด: <span class="text-gray-900 font-semibold">20/12/2548</span></p>
                <p class="text-gray-600">อายุ: <span class="text-gray-900 font-semibold">20</span></p>
                <p class="text-gray-600">เพศ: <span class="text-gray-900 font-semibold">หญิง</span></p>
                <p class="text-gray-600">อาชีพ: <span class="text-gray-900 font-semibold">นักศึกษา</span></p>
                <p class="text-gray-600">เบอร์โทร: <span class="text-gray-900 font-semibold">0987654324</span></p>
                <p class="text-gray-600">จังหวัด: <span class="text-gray-900 font-semibold">นครศรีธรรมราช</span></p>
            </div>
        </div>

        <div class="bg-blue-100 rounded-2xl p-4 mb-8">
            <h3 class="font-bold text-blue-900 mb-3">ประวัติการเข้าร่วมกิจกรรม</h3>
            <div class="space-y-2">
                <div class="bg-blue-400 text-white p-3 rounded-xl flex justify-between cursor-pointer hover:bg-blue-500">
                    <span>กำลังจะมาถึง (0)</span> <span>▼</span>
                </div>
                <div class="bg-blue-400 text-white p-3 rounded-xl flex justify-between cursor-pointer hover:bg-blue-500">
                    <span>ที่ผ่านมา (0)</span> <span>▼</span>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <button class="flex-1 bg-slate-700 text-white py-3 rounded-xl font-bold hover:bg-slate-800 transition">แก้ไขโปรไฟล์</button>
            <button class="flex-1 bg-slate-700 text-white py-3 rounded-xl font-bold hover:bg-slate-800 transition">ออกจากระบบ</button>
        </div>
    </div>

</body>
</html>