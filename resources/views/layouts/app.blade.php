<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>V-SMART</title>
	
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icon/favicon-16x16.png') }}">

    @stack('styles')

</head>
<body class="bg-bg">

    <header>
        @include('partials.header')
    </header>

    <main class="flex flex-col md:flex-row min-h-screen overflow-hidden text-txtl">
        <section class="w-full mx-auto p-6">
            @yield('content') 
        </section>
    </main>

    <footer class="bg-footer p-4 text-center text-txtd">
        © 2024 BPJS Kesehatan Cabang Soreang.
    </footer>

    {{-- SWAL --}}
    @if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
        });
    </script>
    @endif
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tooltip = document.querySelector("#tooltip-patient");
            const target = document.querySelector("[data-tooltip-target='tooltip-patient']");
        
            if (tooltip && target) {
                target.addEventListener("mouseenter", function() {
                    tooltip.classList.remove("invisible", "opacity-0");
                });
        
                target.addEventListener("mouseleave", function() {
                    tooltip.classList.add("invisible", "opacity-0");
                });
            }
        });
    </script>

    @stack('scripts')
    @vite('resources/js/app.js')

</body>
</html>
