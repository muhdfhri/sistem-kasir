<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @if(Route::currentRouteName() == 'register')
                Daftar - SPMT Magang Reguler
            @elseif(Route::currentRouteName() == 'password.request' || Route::currentRouteName() == 'password.reset')
                Lupa Password - SPMT Magang Reguler
            @else
                Login - SPMT Magang Reguler
            @endif
        </title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/webicon-spmt.jpg') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('images/webicon-spmt.jpg') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            primary: '#55B7E3',
                            secondary: '#0E73B9'
                        }
                    }
                }
            }
        </script>

        <!-- Add this to ensure Tailwind is properly loaded -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Add SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="antialiased bg-[#f8f8f7] dark:bg-[#121211] text-[#1b1b18] dark:text-[#EDEDEC]">
        <div id="app">
            <header class="w-full max-w-full bg-white dark:bg-[#161615] sticky top-0 z-50">
                <div class="container mx-auto px-3 py-4">
                    <div class="flex justify-between items-center">
                        <!-- Logo -->
                        <div class="h-10 flex items-center">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-24 object-contain max-h-full">
                            </a>
                        </div>

                        <!-- Right Side Navigation -->
                        <div class="flex items-center space-x-6">
                            @auth
                                @if(auth()->user()->hasRole('mahasiswa'))
                                    <!-- Notification Icon -->
                                    <div class="relative">
                                        <button id="notification-button" 
                                                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0E73B9] dark:focus:ring-[#55B7E3] transition-all duration-300 transform hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                            <!-- Notification Badge -->
                                            <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center transform hover:scale-110 transition-transform duration-300 animate-pulse">3</span>
                                        </button>
                                        
                                        <!-- Notification Dropdown -->
                                        <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 z-50">
                                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                                <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Notifikasi</h3>
                                            </div>
                                            <div class="max-h-60 overflow-y-auto">
                                                <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <div class="flex items-start">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-2 h-2 mt-2 rounded-full bg-[#0E73B9] dark:bg-[#55B7E3]"></div>
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-sm text-gray-700 dark:text-gray-300">Lamaran Anda untuk posisi <span class="font-semibold">Web Developer</span> telah diterima.</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">2 jam yang lalu</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- Add more notifications here -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- User Profile Dropdown -->
                                    <div class="relative">
                                        <button id="user-menu-button" 
                                                class="flex items-center space-x-3 p-2 rounded-lg border border-[#0E73B9] hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0E73B9] dark:focus:ring-[#55B7E3] transition-all duration-300">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] flex items-center justify-center text-white font-semibold">
                                                    {{ substr(auth()->user()->name, 0, 1) }}
                                                </div>
                                                <span class="text-gray-700 dark:text-gray-300 font-medium">{{ auth()->user()->name }}</span>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                 class="h-5 w-5 text-gray-500 transform transition-transform duration-300" 
                                                 fill="none" 
                                                 viewBox="0 0 24 24" 
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        
                                        <!-- User Menu Dropdown -->
                                        <div id="user-menu-dropdown" 
                                             class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 z-50">
                                            <a href="{{ route('mahasiswa.dashboard') }}" 
                                               class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                     class="h-5 w-5 text-[#0E73B9] dark:text-[#55B7E3]" 
                                                     fill="none" 
                                                     viewBox="0 0 24 24" 
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" 
                                                          stroke-linejoin="round" 
                                                          stroke-width="2" 
                                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </svg>
                                                Dashboard
                                            </a>
                                            <a href="{{ route('logout') }}" 
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                               class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                     class="h-5 w-5 text-[#0E73B9] dark:text-[#55B7E3]" 
                                                     fill="none" 
                                                     viewBox="0 0 24 24" 
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" 
                                                          stroke-linejoin="round" 
                                                          stroke-width="2" 
                                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Keluar
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- Login/Register Links for non-authenticated users -->
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('login') }}" class="text-[#0E73B9] dark:text-[#55B7E3] hover:text-opacity-80">Masuk</a>
                                    <a href="{{ route('register') }}" class="bg-[#0E73B9] dark:bg-[#55B7E3] text-white px-4 py-2 rounded-lg hover:bg-opacity-90">Daftar</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-[#f8f8f7] dark:bg-[#121211] pt-12 pb-6">
                <!-- ... existing footer content ... -->
            </footer>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // User menu dropdown toggle
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenuDropdown = document.getElementById('user-menu-dropdown');
            const userMenuArrow = userMenuButton?.querySelector('svg');
            
            if (userMenuButton) {
                userMenuButton.addEventListener('click', function() {
                    userMenuDropdown.classList.toggle('hidden');
                    userMenuArrow.classList.toggle('rotate-180');
                    // Hide notification dropdown when user menu is opened
                    notificationDropdown.classList.add('hidden');
                });
            }
            
            // Notification dropdown toggle
            const notificationButton = document.getElementById('notification-button');
            const notificationDropdown = document.getElementById('notification-dropdown');
            
            if (notificationButton) {
                notificationButton.addEventListener('click', function() {
                    notificationDropdown.classList.toggle('hidden');
                    // Hide user menu dropdown when notification is opened
                    userMenuDropdown.classList.add('hidden');
                    userMenuArrow.classList.remove('rotate-180');
                });
            }
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (userMenuButton && !userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                    userMenuDropdown.classList.add('hidden');
                    userMenuArrow.classList.remove('rotate-180');
                }
                
                if (notificationButton && !notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });

            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle the eye icon
                if (type === 'text') {
                    eyeIcon.classList.remove('hidden');
                } else {
                    eyeIcon.classList.add('hidden');
                }
            });

            // Handle form submission
            const loginForm = document.getElementById('loginForm');
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // ... existing code ...
                })
                .then(response => {
                    if (!response.ok) {
                        throw response;
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Log the response data
                    if (data.success && data.role === 'mahasiswa') {
                        // Show success modal for mahasiswa users
                        Swal.fire({
                            html: `
                                <div class="text-center">
                                    <h2 class="text-2xl font-semibold mb-4">Login Berhasil!</h2>
                                    <p class="text-base text-gray-700 dark:text-gray-300">Selamat datang, {{ auth()->user()->name }}!</p>
                                </div>
                            `,
                            showConfirmButton: true,
                            confirmButtonText: 'Lanjutkan',
                            confirmButtonColor: '#0E73B9'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = data.redirect;
                            }
                        });
                    } else {
                        // For other roles or if success/role is not as expected, redirect directly
                        window.location.href = data.redirect;
                    }
                })
                .catch(error => {
                    // ... existing code ...
                });
            });
        });
        </script>
    </body>
</html>
