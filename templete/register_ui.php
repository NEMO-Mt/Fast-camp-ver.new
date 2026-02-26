<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Camp - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md my-10">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-800 uppercase tracking-wider">Create Account</h1>
            <p class="text-gray-500 mt-2">สมัครสมาชิกเพื่อเข้าใช้งานระบบ</p>
        </div>

        <form action="/register" method="POST" class="space-y-4">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">NAME</label>
                <input type="text" name="name" placeholder="Your Name" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition duration-200">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">E-MAIL</label>
                <input type="email" name="email" placeholder="example@mail.com" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">BIRTHDAY</label>
                <input type="date" name="birthday" required 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">GENDER</label>
                <select name="gender" required 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                    <option value="">-- Select Gender --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">OCCUPATION</label>
                <input type="text" name="occupation" placeholder="e.g. Student, Engineer" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">PASSWORD</label>
                <input type="password" name="password" placeholder="••••••••" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">CONFIRM PASSWORD</label>
                <input type="password" name="confirm_password" placeholder="••••••••" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg transform transition active:scale-95 duration-200 uppercase mt-4">
                Register
            </button>
        </form>

        <div class="mt-6 text-center border-t pt-4">
            <p class="text-gray-600">
                Already have an account? 
                <a href="sign_in.php" class="text-blue-600 font-semibold hover:underline">Sign In</a>
            </p>
        </div>
    </div>

</body>
</html>