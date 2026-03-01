<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0f4c4c 0%, #1a6b6b 50%, #0d3d3d 100%);
        }

        .glass-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex flex-col font-sans antialiased">

    <nav class="w-full px-8 py-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <img src="{{ asset('logo/logo.png') }}" alt="Logo EsyColoc" class="w-[200px] ">
        </div>
    </nav>

    <div class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div class="text-white space-y-6 hidden lg:block">
                <h1 class="text-5xl font-semibold leading-tight">
                    Votre nouvelle façon de<br>
                    <span class="text-emerald-400">gérer la colocation.</span>
                </h1>
                <p class="text-teal-100/70 text-base max-w-md">
                    Une interface intuitive pour organiser vos tâches, vos dépenses et vivre en harmonie avec vos
                    colocataires.
                </p>
            </div>

            <div class="flex justify-center lg:justify-end">
                <div class=" p-8   -3xl w-full max-w-sm shadow-2xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <div id="toast-container" class="fixed top-4 right-4 z-[100] flex flex-col gap-2 w-72">

        @if (session('success'))
            <div
                class="toast-item flex items-center gap-3 p-3 bg-[#0f4c4c] text-white rounded-lg shadow-lg animate-slide-in">
                <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check text-[10px]"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[11px] font-medium truncate">{{ session('success') }}</p>
                </div>
                <button onclick="removeToast(this)" class="text-white/60 hover:text-white flex-shrink-0">
                    <i class="fas fa-times text-[10px]"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="toast-item flex items-center gap-3 p-3 bg-red-500 text-white rounded-lg shadow-lg animate-slide-in">
                <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation text-[10px]"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[11px] font-medium truncate">{{ session('error') }}</p>
                </div>
                <button onclick="removeToast(this)" class="text-white/60 hover:text-white flex-shrink-0">
                    <i class="fas fa-times text-[10px]"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div
                    class="toast-item flex items-center gap-3 p-3 bg-white border-l-4 border-red-500 text-gray-800 rounded-lg shadow-lg animate-slide-in">
                    <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation text-red-500 text-[10px]"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[11px] font-medium truncate">{{ $error }}</p>
                    </div>
                    <button onclick="removeToast(this)" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                        <i class="fas fa-times text-[10px]"></i>
                    </button>
                </div>
            @endforeach
        @endif

    </div>

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }

        .animate-slide-out {
            animation: slideOut 0.2s ease-in forwards;
        }
    </style>

    <script>
        function removeToast(btn) {
            const toast = btn.closest('.toast-item');
            toast.classList.remove('animate-slide-in');
            toast.classList.add('animate-slide-out');
            setTimeout(() => toast.remove(), 200);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.toast-item').forEach(toast => {
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.classList.add('animate-slide-out');
                        setTimeout(() => toast.remove(), 200);
                    }
                }, 4000);
            });
        });
    </script>
</body>

</html>
