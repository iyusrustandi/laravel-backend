{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dark:bg-gray-900 bg-white">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Sidebar -->
    @include('components.aside')

    <!-- Main Content -->
    <main class="p-4 md:ml-64 h-auto pt-20">
        <div class="container mx-auto p-4">
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            function enableDarkMode() {
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkmode', 'enabled');
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            }

            function disableDarkMode() {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkmode', 'disabled');
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            }

            // Check the current theme preference in localStorage
            if (localStorage.getItem('darkmode') === 'enabled') {
                enableDarkMode();
            } else {
                disableDarkMode();
            }

            themeToggleBtn.addEventListener('click', () => {
                if (localStorage.getItem('darkmode') !== 'enabled') {
                    enableDarkMode();
                } else {
                    disableDarkMode();
                }
            });
        });
    </script>
</body>
</html>
