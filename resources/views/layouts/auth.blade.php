<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Autentikasi' }} - FANES.GO</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind via Vite --}}
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
        }

        .modern-input {
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            transition: all 0.3s ease;
        }

        .modern-input:focus {
            background: #ffffff;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
            outline: none;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(40px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-gray-900"
      style="background-image:url('https://images.unsplash.com/photo-1615484477745-a433027a2778'); background-size:cover; background-position:center;">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-950/80 via-gray-900/60 to-emerald-950/80"></div>

    {{-- Glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-emerald-500/20 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] bg-teal-400/20 rounded-full blur-[120px]"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 w-full flex justify-center fade-in-up py-10">
        @yield('content')
    </div>

</body>
</html>
