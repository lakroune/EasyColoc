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
</body>

</html>
