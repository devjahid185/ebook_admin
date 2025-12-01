<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex items-center justify-center p-6">


    <div class="bg-white/10 backdrop-blur-lg shadow-xl rounded-2xl p-10 w-full max-w-md border border-white/20">
        <h2 class="text-3xl font-semibold text-white mb-6 text-center">Admin Login</h2>


        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf


            <div>
                <label class="text-gray-200 text-sm mb-1 block">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-gray-300 outline-none focus:ring focus:ring-blue-500" placeholder="admin@example.com" required>
                @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>


            <div>
                <label class="text-gray-200 text-sm mb-1 block">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-gray-300 outline-none focus:ring focus:ring-blue-500" placeholder="••••••••" required>
            </div>


            <button class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">Login</button>
        </form>
    </div>


</body>

</html>