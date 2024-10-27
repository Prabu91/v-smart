<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard' }}</title>
	
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('styles')

</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header>
        @include('partials.header') <!-- Komponen header yang telah dibuat -->
    </header>

    <!-- Main Content -->
    <main class="flex flex-col md:flex-row min-h-screen">
        <section class="w-full mx-auto p-6">
            @yield('content') <!-- Konten utama halaman -->
        </section>
    </main>

    <!-- Footer (Opsional) -->
    <footer class="bg-white p-4 text-center">
        © {{ date('Y') }} Your Company. All rights reserved.
    </footer>

    <!-- Scripts -->
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    @stack('scripts')
    @vite('resources/js/app.js')

</body>
</html>
