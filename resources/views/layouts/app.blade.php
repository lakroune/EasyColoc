<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .sidebar {
            transition: all 0.3s;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="min-h-screen flex">

        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col min-w-0">

            <div class="lg:hidden bg-white px-6 py-4 flex items-center justify-between border-b border-gray-100">
                <span class="font-bold text-gray-800">EasyColoc</span>
                <button onclick="document.getElementById('sidebar').classList.toggle('open')" class="text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <main class="flex-1 overflow-y-auto p-4 lg:p-8">
                <div class="max-w-5xl mx-auto">
                    @isset($header)
                        <div class="mb-6">
                            {{ $header }}
                        </div>
                    @endisset

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    {{-- Toast Container --}}
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

        // Auto-remove after 4 seconds
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
