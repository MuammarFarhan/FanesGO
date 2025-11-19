<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Autentikasi' }} - FANES.GO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen"
    style="background-image: url('{{ asset('images/kue.jpeg') }}'); background-size: cover; background-position: center;">
    @yield('content')
</body>

</html>