<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Ecoseastem')</title>
    <!-- Add Tailwind CSS -->
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // JavaScript to toggle the profile dropdown visibility
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuButton = document.getElementById('user-menu-button');
            const dropdownMenu = document.getElementById('user-menu');

            // Toggle profile dropdown
            userMenuButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // JavaScript to toggle mobile menu visibility
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            // Toggle mobile menu
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
    <style>
/* Ensure the parent container has relative positioning and overflow hidden */
.banner {
    position: relative;
    overflow: hidden;
}

/* Apply curve to the div with class 'curve' */
.banner .curve {
    position: absolute; /* Position the curve element correctly */
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px; /* Adjust height for the curve */
    background-color: #1e40af; /* Ensure the background color matches the banner */
    clip-path: ellipse(70% 30% at 50% 100%); /* Create the curve */
}

    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    @include('layout.navbar')

    <main class="container mx-auto my-8 flex-grow mt-0">
        @yield('content')
        @if (session('message'))
            @include('layout.popup', ['message' => session('message')])
        @elseif (session('error'))
            @include('layout.popup', ['error' => session('error')])
        @endif
    </main>

    @include('layout.footer')
</body>
</html>
