<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Autentikasi' }} - FANES.GO</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-card {
            /* Glass effect yang lebih tebal agar kontras dengan tekstur background */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
        }

        .modern-input {
            background: #f0fdf4; /* Hijau Mint Sangat Muda */
            border: 1px solid #dcfce7;
            transition: all 0.3s ease;
        }

        .modern-input:focus {
            background: #ffffff;
            border-color: #10b981; /* Emerald 500 */
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
      style="background-image: url('https://images.unsplash.com/photo-1615484477745-a433027a2778?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;">
    
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-950/80 via-gray-900/60 to-emerald-950/80 backdrop-blur-[1px]"></div>

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-emerald-500/20 rounded-full blur-[120px] mix-blend-screen"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-teal-400/20 rounded-full blur-[120px] mix-blend-screen"></div>
    </div>

    <div class="relative z-10 w-full flex justify-center items-center fade-in-up py-10">
        @yield('content')
    </div>

</body>
</html>