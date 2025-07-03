<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - wanZadia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('/images/bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="min-h-screen bg-black bg-opacity-70 flex items-center justify-center">

    <div class="bg-gray-900 bg-opacity-80 p-10 rounded-lg shadow-xl w-full max-w-md">
        <h2 class="text-white text-3xl font-bold mb-6 text-center">Masuk ke <span class="text-red-500">wanZadia</span></h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <input type="email" name="email" required autofocus
                       class="w-full p-3 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                       placeholder="Email">
            </div>

            <div class="mb-6">
                <input type="password" name="password" required
                       class="w-full p-3 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                       placeholder="Password">
            </div>

            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded font-semibold transition">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>
