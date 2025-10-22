<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OzPay — Billing Wi-Fi Mudah & Cepat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes floaty {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-floaty {
            animation: floaty 4s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-zinc-950 via-zinc-900 to-zinc-950 text-zinc-100 flex items-center justify-center">

    <div class="text-center px-6">
        <!-- logo -->
        <div class="flex justify-center mb-6">
            <div
                class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-400 to-sky-500 text-zinc-900 animate-floaty shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path d="M5 12.55a11 11 0 0 1 14.08 0" />
                    <path d="M1.42 9a16 16 0 0 1 21.16 0" />
                    <path d="M8.53 16.11a6 6 0 0 1 6.95 0" />
                    <circle cx="12" cy="20" r="1" />
                </svg>
            </div>
        </div>

        <!-- heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-3">
            Selamat Datang di <span
                class="bg-gradient-to-r from-emerald-400 to-sky-500 bg-clip-text text-transparent">OzPay</span>
        </h1>
        <p class="text-zinc-400 max-w-md mx-auto mb-8">
            Sistem pembayaran dan tagihan Wi-Fi otomatis. Lebih cepat, lebih mudah, tanpa ribet.
        </p>

        <!-- tombol login -->
        <a href="{{ route('login', absolute: false) ?? '/login' }}"
            class="inline-flex items-center px-6 py-3 rounded-2xl bg-gradient-to-r from-emerald-400 to-sky-500 text-zinc-900 font-medium shadow hover:opacity-90 transition">
            Login Sekarang
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
            </svg>
        </a>
    </div>

</body>

</html>
