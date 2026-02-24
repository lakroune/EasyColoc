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
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        /* التأكد من أن القائمة الجانبية تعمل بشكل متجاوب */
        .sidebar { transition: all 0.3s; }
        @media (max-width: 1024px) { 
            .sidebar { transform: translateX(-100%); position: fixed; } 
            .sidebar.open { transform: translateX(0); } 
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
</body>
</html>