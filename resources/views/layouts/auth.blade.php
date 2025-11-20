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
            /* Background putih susu transparan agar tulisan terbaca jelas di atas background kue */
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.25); /* Bayangan hijau tua */
        }

        .modern-input {
            background: #f0fdf4; /* Hijau sangat muda (Mint) */
            border: 1px solid #bbf7d0;
            transition: all 0.3s ease;
        }

        .modern-input:focus {
            background: #ffffff;
            border-color: #059669;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
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

<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-emerald-900"
      style="background-image: url('https://images.unsplash.com/photo-1541696490-8744a5dc0228?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;">
    
    <div class="absolute inset-0 bg-emerald-950/60 backdrop-blur-[2px]"></div>

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-lime-400/20 rounded-full blur-[100px] mix-blend-screen"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] bg-emerald-600/30 rounded-full blur-[100px] mix-blend-overlay"></div>
    </div>

    <div class="relative z-10 w-full flex justify-center items-center fade-in-up py-10">
        @yield('content')
    </div>

</body>
</html>