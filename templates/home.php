<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAST-CAMP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50">
    <nav class="flex justify-between p-6 bg-white shadow-sm">
            <div class="font-bold test-blue-900">FAST CAMP</div>
            <div class="space-x-4">
                <a href="">กิจจกรรมลงทะเบียน</a>
                <a href="">การลงทะเบียน</a>
                <button>เข้าสู่ระบบ</button>
            </div>
    </nav>
    <main class="p-10">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <?php foreach ($data['activities'] as $activity): ?>
            <div class="bg-white p-4 rounded-2xl shadow-md">
                <div class="bg-blue-100 h-40 rounded-xl mb-4 flex items-center justify-center">
                    <?php if ($activity['image_path']): ?>
                        <img src="<?= $activity['image_path'] ?>" class="h-full w-full object-cover rounded-xl">
                    <?php else: ?>
                        <span class="text-blue-300 text-4xl">🖼️</span>
                    <?php endif; ?>
                </div>
                
                [cite_start]<h2 class="font-bold text-blue-900"><?= htmlspecialchars($activity['title']) ?></h2> [cite: 4]
                [cite_start]<p class="text-xs text-gray-500 mt-1">📍 <?= htmlspecialchars($activity['location']) ?></p> [cite: 4]
                [cite_start]<p class="text-xs text-gray-400 mt-2 line-clamp-2"><?= htmlspecialchars($activity['detail']) ?></p> [cite: 4]
                
                <button class="w-full bg-blue-200 mt-4 py-2 rounded-lg text-sm text-blue-700 font-semibold">
                    รายละเอียด
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>