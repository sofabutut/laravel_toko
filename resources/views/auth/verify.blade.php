<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email - wanZadia</title>
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

    <div class="bg-gray-900 bg-opacity-80 p-10 rounded-lg shadow-xl w-full max-w-md text-center text-white">
        <h2 class="text-2xl font-bold mb-4">Verifikasi Email Kamu</h2>
        <p class="mb-6">Kami telah mengirim email verifikasi ke alamat email kamu. Silakan buka email dan klik link verifikasinya sebelum lanjut.</p>

        @if (session('status') == 'verification-link-sent')
            <p class="text-green-400 mb-4">
                Link verifikasi baru telah dikirim ke email kamu!
            </p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded font-semibold">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="text-sm text-gray-300 hover:text-white underline">
                Logout
            </button>
        </form>
    </div>
</body>
</html>
