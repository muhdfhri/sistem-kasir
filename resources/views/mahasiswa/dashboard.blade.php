<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Mahasiswa - SPMT Magang Reguler</title>
    
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
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div id="app">
        <!-- Dashboard Header with User Profile and Notifications -->
        <header class="bg-white dark:bg-gray-800 shadow-md transition-all duration-300">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="h-10 flex items-center">
                        <a href="{{ url('/') }}" class="transform hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-24 object-contain max-h-full">
                        </a>
                    </div>

                    <!-- Right Side Navigation -->
                    <div class="flex items-center space-x-6">
                        <!-- Notification Icon -->
                        <div class="relative">
                            <button id="notification-button" 
                                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0E73B9] dark:focus:ring-[#55B7E3] transition-all duration-300 transform hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <!-- Notification Badge with Animation -->
                                <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center transform hover:scale-110 transition-transform duration-300 animate-pulse">3</span>
                            </button>
                            
                            <!-- Enhanced Notification Dropdown with Responsive Design -->
                            <div id="notification-dropdown" class="hidden fixed md:absolute right-0 mt-2 w-[calc(100vw-2rem)] md:w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 z-50 transform transition-all duration-300 origin-top-right">
                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        Notifikasi
                                    </h3>
                                </div>
                                <div class="max-h-[60vh] md:max-h-60 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
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
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-2 h-2 mt-2 rounded-full bg-[#0E73B9] dark:bg-[#55B7E3]"></div>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-gray-700 dark:text-gray-300">Jangan lupa untuk mengisi laporan bulanan bulan ini.</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">1 hari yang lalu</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-2 h-2 mt-2 rounded-full bg-[#0E73B9] dark:bg-[#55B7E3]"></div>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-gray-700 dark:text-gray-300">Lamaran Anda untuk posisi <span class="font-semibold">UI/UX Designer</span> sedang diproses.</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">3 hari yang lalu</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 text-center">
                                    <a href="#" class="text-sm text-[#0E73B9] dark:text-[#55B7E3] hover:underline transition-colors duration-200">Lihat semua notifikasi</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Enhanced User Profile Button -->
                        <div class="relative min-w-[200px]">
                            <button id="user-menu-button" 
                                    class="flex items-center justify-between w-full space-x-3 p-2 rounded-lg border border-[#0E73B9] hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0E73B9] dark:focus:ring-[#55B7E3] transition-all duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] flex items-center justify-center text-white font-semibold transform hover:scale-105 transition-transform duration-300">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">{{ Auth::user()->name }}</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 text-gray-500 transform transition-transform duration-300" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Enhanced User Menu Dropdown -->
                            <div id="user-menu-dropdown" 
                                 class="hidden absolute left-0 mt-2 w-full min-w-[200px] bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 z-10 transform transition-all duration-300 origin-top-right">
                                <a href="#" 
                                   onclick="showLogoutConfirmation(event)" 
                                   class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
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
                    </div>
                </div>
            </div>
        </header>

        <!-- Bottom Navigation Bar (only visible on desktop/laptop) -->
        <div id="bottom-navbar" class="hidden md:block w-full max-w-full bg-white dark:bg-gray-800 shadow-md transition-[box-shadow] duration-300">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-end items-center">
                    <!-- Bottom Navigation Menu -->
                    <nav class="flex items-center space-x-8">
                        <a href="#jobs"
                            class="flex items-center text-gray-700 dark:text-gray-300 hover:text-[#0E73B9] dark:hover:text-[#55B7E3] transition-colors duration-200 group">
                            <div class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 shadow-sm group-hover:shadow-md transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <span class="font-medium">Cari Lowongan</span>
                        </a>

                        <!-- Dropdown for Divisions -->
                        <div class="relative group">
                            <button class="flex items-center text-gray-700 dark:text-gray-300 hover:text-[#0E73B9] dark:hover:text-[#55B7E3] transition-colors duration-200">
                                <div class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 shadow-sm group-hover:shadow-md transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </div>
                                <span class="font-medium">List Divisi/Bidang</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 ml-1 transform transition-transform duration-200 group-hover:rotate-180"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-10">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                        Teknologi Informasi
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                        Keuangan
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                        Marketing
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                        Operasional
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                        Sumber Daya Manusia
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 rounded-b-lg bg-white dark:bg-gray-900 shadow-lg transform transition-all duration-300 ease-in-out">
            <div class="px-4 space-y-1">
                <!-- Mobile Navigation Links -->
                <a href="{{ url('/') }}"
                    class="block py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Beranda
                    </span>
                </a>
                <a href="#about"
                    class="block py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Tentang SPMT
                    </span>
                </a>
                <a href="#programs"
                    class="block py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Program
                    </span>
                </a>
                <a href="#jobs"
                    class="block py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Cari Lowongan
                    </span>
                </a>

                <!-- Mobile List Divisi/Bidang Link -->
                 <a href="#"
                    class="block py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        List Divisi/Bidang
                    </span>
                </a>

                <!-- Mobile User Menu (Authenticated) -->
                @auth
                    @if(Auth::user()->role == 'mahasiswa')
                        <!-- Mobile User Menu Dropdown -->
                        <div class="py-2 border-t border-gray-200 dark:border-gray-700 mt-2">
                             <button class="flex items-center justify-between w-full text-left text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200 p-3" id="mobile-user-menu-button">
                                <span class="flex items-center">
                                     <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] flex items-center justify-center text-white font-semibold text-sm mr-2">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                     </div>
                                    {{ Auth::user()->name }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transform transition-transform duration-200" id="mobile-user-menu-arrow"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                             <div class="hidden pl-4 mt-2 space-y-1" id="mobile-user-menu-dropdown">
                                 <a href="#" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                                      <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        Notifikasi
                                     </span>
                                 </a>
                                 <a href="{{ route('profile') }}" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                                     <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Lihat Profil
                                    </span>
                                 </a>
                                 <a href="{{ route('mahasiswa.dashboard') }}" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                                      <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Dashboard
                                    </span>
                                 </a>
                                 <a href="#" onclick="showLogoutConfirmation(event)" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                                      <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </span>
                                 </a>
                             </div>
                        </div>
                         <!-- Mobile User Info Card -->
                        <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] flex items-center justify-center text-white font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Mobile Login Button for non-mahasiswa users -->
                        <div class="mt-4">
                            <a href="{{ route('login') }}"
                                class="flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] text-white rounded-lg text-sm font-medium shadow-sm hover:shadow-lg transform hover:-translate-y-0.5 transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Masuk
                            </a>
                        </div>
                    @endif
                @else
                    <!-- Mobile Login Button for guests -->
                    <div class="mt-4">
                        <a href="{{ route('login') }}"
                            class="flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] text-white rounded-lg text-sm font-medium shadow-sm hover:shadow-lg transform hover:-translate-y-0.5 transition duration-300 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Masuk
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <main class="py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-[#f8f8f7] dark:bg-[#121211] pt-12 pb-6">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <!-- Company Info -->
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">SPMT</h3>
                        <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">
                            Platform digital untuk mengelola proses magang mahasiswa, mulai dari pendaftaran, seleksi, hingga pelaporan selama program magang.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-[#0E73B9] dark:text-[#55B7E3] hover:text-opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                </svg>
                            </a>
                            <a href="#" class="text-[#0E73B9] dark:text-[#55B7E3] hover:text-opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="#" class="text-[#0E73B9] dark:text-[#55B7E3] hover:text-opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                                </svg>
                            </a>
                            <a href="#" class="text-[#0E73B9] dark:text-[#55B7E3] hover:text-opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Tautan Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Beranda</a></li>
                            <li><a href="#about" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Tentang Kami</a></li>
                            <li><a href="#jobs" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Lowongan Magang</a></li>
                            <li><a href="#faq" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">FAQ</a></li>
                        </ul>
                    </div>

                    <!-- Resources -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Sumber Daya</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Panduan Magang</a></li>
                            <li><a href="#" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Tips Wawancara</a></li>
                            <li><a href="#" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Blog</a></li>
                            <li><a href="#" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Berita</a></li>
                            <li><a href="#" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Acara</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Hubungi Kami</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-[#706f6c] dark:text-[#A1A09A]">Jl. Contoh No. 123, Jakarta, Indonesia</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-[#706f6c] dark:text-[#A1A09A]">info@spmt.com</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0E73B9] dark:text-[#55B7E3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-[#706f6c] dark:text-[#A1A09A]">(021) 1234-5678</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-[#e6e6e4] dark:border-[#2a2a28] pt-6">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mb-4 md:mb-0">
                            &copy; {{ date('Y') }} SPMT. Hak Cipta Dilindungi.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-[#706f6c] dark:text-[#A1A09A] text-sm hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Kebijakan Privasi</a>
                            <a href="#" class="text-[#706f6c] dark:text-[#A1A09A] text-sm hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Syarat & Ketentuan</a>
                            <a href="#" class="text-[#706f6c] dark:text-[#A1A09A] text-sm hover:text-[#0E73B9] dark:hover:text-[#55B7E3]">Peta Situs</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-8 max-w-sm w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 dark:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Konfirmasi Keluar</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin keluar dari sistem? Anda perlu login kembali untuk mengakses sistem.
                </p>
                <div class="flex justify-center space-x-4">
                    <button onclick="hideLogoutConfirmation()" 
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                        Batal
                    </button>
                    <button onclick="confirmLogout()" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                        Ya, Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="logout-toast" class="fixed bottom-4 right-4 transform translate-y-full opacity-0 transition-all duration-300 ease-in-out">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>Berhasil keluar dari sistem</span>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get DOM elements
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuLines = document.querySelectorAll('[id^="menu-line-"]');
        const userMenuButton = document.getElementById('user-menu-button'); // Desktop user menu button
        const userMenuDropdown = document.getElementById('user-menu-dropdown'); // Desktop user menu dropdown
        const notificationButton = document.getElementById('notification-button'); // Desktop notification button
        const notificationDropdown = document.getElementById('notification-dropdown'); // Desktop notification dropdown
        const navbar = document.getElementById('navbar');

        // Toggle mobile menu
        if (mobileMenuButton && mobileMenu && menuLines.length === 3) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');

                // Animate menu lines
                menuLines[0].classList.toggle('rotate-45');
                menuLines[0].classList.toggle('translate-y-2');
                menuLines[1].classList.toggle('opacity-0');
                menuLines[2].classList.toggle('-rotate-45');
                menuLines[2].classList.toggle('-translate-y-2');
            });
        }

        // Desktop user menu dropdown toggle
        if (userMenuButton && userMenuDropdown) {
             const userMenuArrow = userMenuButton.querySelector('svg'); // Get the arrow for the desktop menu

             userMenuButton.addEventListener('click', function() {
                 userMenuDropdown.classList.toggle('hidden');
                 userMenuArrow.classList.toggle('rotate-180');
                 // Hide notification dropdown when user menu is opened
                 if (notificationDropdown) {
                     notificationDropdown.classList.add('hidden');
                 }
             });
        }

        // Close dropdowns when clicking outside with smooth animation
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                userMenuDropdown.classList.add('hidden');
                userMenuArrow.classList.remove('rotate-180');
            }
            
            if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.classList.add('hidden');
            }
        });

        // Close modal when clicking outside
        const logoutModal = document.getElementById('logout-modal');
        logoutModal.addEventListener('click', function(event) {
            if (event.target === logoutModal) {
                hideLogoutConfirmation();
            }
        });

        // Mobile user menu dropdown toggle with animation
        const mobileUserMenuButton = document.getElementById('mobile-user-menu-button');
        const mobileUserMenuDropdown = document.getElementById('mobile-user-menu-dropdown');
        const mobileUserMenuArrow = document.getElementById('mobile-user-menu-arrow');

        if (mobileUserMenuButton) { // Add a check if the button exists
            mobileUserMenuButton.addEventListener('click', function() {
                mobileUserMenuDropdown.classList.toggle('hidden');
                mobileUserMenuArrow.classList.toggle('rotate-180');
            });
        }

        // Logout confirmation (if exists)
        window.showLogoutConfirmation = function(event) {
            event.preventDefault();
            showLogoutConfirmation(); // Call the modal function
        }

        // Desktop notification dropdown toggle
        if (notificationButton && notificationDropdown) {
            notificationButton.addEventListener('click', () => {
                notificationDropdown.classList.toggle('hidden');
            });
        }

        // Splide Carousel Initialization
        new Splide('#hero-carousel', {
            type: 'loop',
            autoplay: true,
            interval: 5000,
            pauseOnHover: true,
            resetProgress: false,
            arrows: true,
            pagination: true,
        }).mount();
    });

    // Logout Modal Functions
    function showLogoutConfirmation(event) {
        event.preventDefault();
        const modal = document.getElementById('logout-modal');
        const modalContent = document.getElementById('modal-content');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Trigger animation
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideLogoutConfirmation() {
        const modal = document.getElementById('logout-modal');
        const modalContent = document.getElementById('modal-content');
        
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }

    function confirmLogout() {
        // Show loading state
        const logoutButton = document.querySelector('#logout-modal button:last-child');
        const originalText = logoutButton.innerHTML;
        logoutButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memproses...
        `;
        logoutButton.disabled = true;

        // Show success toast
        const toast = document.getElementById('logout-toast');
        toast.classList.remove('translate-y-full', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-full', 'opacity-0');
        }, 3000);

        // Submit the logout form after a short delay
        setTimeout(() => {
            document.getElementById('logout-form').submit();
        }, 1000);
    }
    </script>

</body>
</html> 