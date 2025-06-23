<!-- Top Navigation Bar -->
<header id="navbar" class="w-full max-w-full bg-white dark:bg-[#161615] sticky top-0 z-50 transition-all duration-300 transform">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="h-10 flex items-center">
                <a href="{{ url('/') }}" class="block">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-24 object-contain max-h-full">
                </a>
            </div>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/') }}"
                    class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#0E73B9] dark:hover:text-[#55B7E3] transition-colors duration-200">
                    Beranda
                </a>
                <a href="#about"
                    class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#0E73B9] dark:hover:text-[#55B7E3] transition-colors duration-200">
                    Tentang SPMT
                </a>
                <a href="#programs"
                    class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#0E73B9] dark:hover:text-[#55B7E3] transition-colors duration-200">
                    Program
                </a>

                @auth
                @if(Auth::user()->role == 'mahasiswa')
                <!-- Notification Button -->
                <div class="relative">
                    <button id="notification-button"
                        class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0E73B9] dark:focus:ring-[#55B7E3] transition-all duration-300">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-[#1b1b18] dark:text-[#EDEDEC]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </div>
                    </button>

                    <!-- Notification Dropdown -->
                    <div id="notification-dropdown"
                        class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 z-10 transform transition-all duration-300 origin-top-right">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Notifikasi</h3>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            <!-- Notification Items -->
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900 rounded-full p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Pengumuman Penting</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pendaftaran magang periode Juli-Desember telah dibuka.</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">2 jam yang lalu</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="#" class="text-xs text-[#0E73B9] dark:text-[#55B7E3] hover:underline">Lihat semua notifikasi</a>
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
                        class="hidden absolute right-0 mt-2 w-full min-w-[200px] bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 z-10 transform transition-all duration-300 origin-top-right">
                        <a href="{{ route('profile') }}"
                            class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-[#0E73B9] dark:text-[#55B7E3]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Lihat Profil
                        </a>
                        <a href="{{ route('mahasiswa.dashboard') }}"
                            class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
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
                @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] text-white rounded-md text-sm font-medium shadow-sm hover:shadow-lg transform hover:-translate-y-0.5 transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Masuk
                </a>
                @endif
                @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] text-white rounded-md text-sm font-medium shadow-sm hover:shadow-lg transform hover:-translate-y-0.5 transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Masuk
                </a>
                @endauth
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button"
                    class="relative p-2 rounded-lg bg-white dark:bg-gray-900 text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gradient-to-r hover:from-[#55B7E3] hover:to-[#0E73B9] hover:text-white dark:hover:text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#0E73B9]">
                    <div class="w-6 h-6 flex flex-col justify-center items-center">
                        <span class="block w-6 h-0.5 bg-[#1b1b18] dark:bg-[#EDEDEC] transform transition-all duration-300 ease-in-out" id="menu-line-1"></span>
                        <span class="block w-6 h-0.5 bg-[#1b1b18] dark:bg-[#EDEDEC] transform transition-all duration-300 ease-in-out mt-1.5" id="menu-line-2"></span>
                        <span class="block w-6 h-0.5 bg-[#1b1b18] dark:bg-[#EDEDEC] transform transition-all duration-300 ease-in-out mt-1.5" id="menu-line-3"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Secondary Navigation -->
<div class="w-full bg-gradient-to-r from-[#55B7E3] to-[#0E73B9] dark:from-[#55B7E3] dark:to-[#0E73B9] border-t border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex justify-end items-center py-3">
            <div class="flex items-center space-x-8">
                <a href="#jobs" class="group flex items-center space-x-2 text-white hover:text-white/90 transition-all duration-200">
                    <div class="p-2 rounded-lg bg-white/10 backdrop-blur-sm shadow-sm group-hover:shadow-md transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="font-medium">Cari Lowongan</span>
                </a>
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-white hover:text-white/90 transition-all duration-200">
                        <div class="p-2 rounded-lg bg-white/10 backdrop-blur-sm shadow-sm group-hover:shadow-md transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="font-medium">List Divisi/Bidang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-2 hidden group-hover:block z-50 transform transition-all duration-200">
                        <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Divisi & Bidang</h3>
                        </div>
                        <div class="p-2 space-y-2">
                            <a href="#" class="block p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Teknologi Informasi</h4>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Pengembangan software, jaringan, dan infrastruktur IT</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Keuangan</h4>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Akuntansi, analisis keuangan, dan perpajakan</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Marketing</h4>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Digital marketing, branding, dan komunikasi</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 dark:text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Operasional</h4>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Manajemen operasi, logistik, dan supply chain</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 dark:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Sumber Daya Manusia</h4>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Rekrutmen, pengembangan karyawan, dan administrasi HR</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Menu -->
<div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 rounded-b-lg bg-gradient-to-r from-[#55B7E3] to-[#0E73B9] dark:from-[#55B7E3] dark:to-[#0E73B9] shadow-lg transform transition-all duration-300 ease-in-out">
    <div class="px-4 space-y-1">
        <!-- Mobile Navigation Links -->
        <a href="{{ url('/') }}"
            class="block py-3 text-white hover:bg-white/10 rounded-lg transition-colors duration-200">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </span>
        </a>
        <a href="#about"
            class="block py-3 text-white hover:bg-white/10 rounded-lg transition-colors duration-200">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tentang SPMT
            </span>
        </a>
        <a href="#programs"
            class="block py-3 text-white hover:bg-white/10 rounded-lg transition-colors duration-200">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/0000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Program
            </span>
        </a>

        <!-- Mobile Dropdown for Divisions -->
        <div class="py-2">
            <button class="flex items-center justify-between w-full text-left text-white hover:bg-white/10 rounded-lg transition-colors duration-200 p-3"
                id="mobile-dropdown-button">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    List Divisi/Bidang
                </span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 transform transition-transform duration-200"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    id="dropdown-arrow">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="hidden mt-2 grid grid-cols-1 gap-2 px-4" id="mobile-dropdown-menu">
                <!-- Division Cards -->
                <a href="#" class="block p-3 bg-white/10 backdrop-blur-sm rounded-lg hover:bg-white/20 transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 p-2 bg-white/20 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">Teknologi Informasi</h4>
                            <p class="text-sm text-white/80 mt-1">Pengembangan software, jaringan, dan infrastruktur IT</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-3 bg-white/10 backdrop-blur-sm rounded-lg hover:bg-white/20 transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 p-2 bg-white/20 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">Keuangan</h4>
                            <p class="text-sm text-white/80 mt-1">Akuntansi, analisis keuangan, dan perpajakan</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-3 bg-white/10 backdrop-blur-sm rounded-lg hover:bg-white/20 transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 p-2 bg-white/20 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">Marketing</h4>
                            <p class="text-sm text-white/80 mt-1">Digital marketing, branding, dan komunikasi</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-3 bg-white/10 backdrop-blur-sm rounded-lg hover:bg-white/20 transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 p-2 bg-white/20 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">Operasional</h4>
                            <p class="text-sm text-white/80 mt-1">Manajemen operasi, logistik, dan supply chain</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-3 bg-white/10 backdrop-blur-sm rounded-lg hover:bg-white/20 transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 p-2 bg-white/20 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">Sumber Daya Manusia</h4>
                            <p class="text-sm text-white/80 mt-1">Rekrutmen, pengembangan karyawan, dan administrasi HR</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Mobile User Menu (Authenticated) -->
        @auth
        @if(Auth::user()->role == 'mahasiswa')
        <!-- Mobile User Dropdown -->
        <div class="py-2">
            <button class="flex items-center justify-between w-full text-left text-white hover:bg-white/10 rounded-lg transition-colors duration-200 p-3"
                id="mobile-user-dropdown-button">
                <span class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-semibold mr-2">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 transform transition-transform duration-200"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    id="user-dropdown-arrow">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="hidden pl-4 mt-2 space-y-1" id="mobile-user-dropdown-menu">
                <!-- Notification Link -->
                <a href="#" class="block py-2 px-3 text-white hover:bg-white/10 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Notifikasi
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </span>
                </a>

                <!-- Profile Link -->
                <a href="{{ route('profile') }}" class="block py-2 px-3 text-white hover:bg-white/10 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Lihat Profil
                    </span>
                </a>

                <!-- Dashboard Link -->
                <a href="{{ route('mahasiswa.dashboard') }}" class="block py-2 px-3 text-white hover:bg-white/10 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </span>
                </a>

                <!-- Logout Link -->
                <a href="#" onclick="showLogoutConfirmation(event)" class="block py-2 px-3 text-white hover:bg-white/10 rounded-lg transition-colors duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </span>
                </a>
            </div>
        </div>
        @else
        <!-- Mobile Login Button for non-mahasiswa users -->
        <div class="mt-4">
            <a href="{{ route('login') }}"
                class="flex items-center justify-center gap-2 px-5 py-3 bg-white/10 backdrop-blur-sm text-white rounded-lg text-sm font-medium hover:bg-white/20 transition duration-300 ease-in-out">
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
                class="flex items-center justify-center gap-2 px-5 py-3 bg-white/10 backdrop-blur-sm text-white rounded-lg text-sm font-medium hover:bg-white/20 transition duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                Masuk
            </a>
        </div>
        @endauth
    </div>
</div>

<main>
    <!-- Splide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <section class="relative bg-white dark:bg-[#161615] overflow-hidden">
        <div id="hero-carousel" class="splide" role="group" aria-label="SPMT Hero Carousel">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- Carousel Item 1 (Background Image) -->
                    <li class="splide__slide">
                        <div class="relative overflow-hidden bg-cover bg-center h-full" style="background-image: url('/images/background-hero.jpeg'); min-height: 70vh;">
                            <div class="absolute inset-0 bg-black opacity-50"></div>
                            <div class="flex flex-col md:flex-row items-center justify-between px-6 md:px-12 py-24 md:py-32 w-full mx-auto relative z-10 h-full">
                                <div class="md:w-1/2 mb-8 md:mb-0 animate__animated animate__fadeInLeft text-white">
                                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Sistem Pengelolaan Magang Terpadu</h1>
                                    <p class="text-lg mb-6">Platform digital untuk mengelola proses magang mahasiswa, mulai dari pendaftaran, seleksi, hingga pelaporan selama program magang.</p>
                                    <div class="flex space-x-4">
                                        <a href="#jobs" class="inline-block px-6 py-3 bg-[#0E73B9] dark:bg-[#55B7E3] text-white rounded-md hover:bg-[#0a5a8f] dark:hover:bg-[#3a9fd0] transition duration-300">Cari Lowongan</a>
                                        <a href="#about" class="inline-block px-6 py-3 border border-white/50 text-white rounded-md hover:border-white/80 transition duration-300">Pelajari Lebih Lanjut</a>
                                    </div>
                                </div>
                                <div class="md:w-1/2 animate__animated animate__fadeInRight">
                                    <!-- Content on right if needed -->
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Carousel Item 2 -->
                    <li class="splide__slide">
                         <div class="flex flex-col md:flex-row items-center justify-between px-6 md:px-12 py-24 md:py-32 container mx-auto" style="min-height: 70vh;">
                            <div class="md:w-1/2 mb-8 md:mb-0 animate__animated animate__fadeInLeft">
                                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Kembangkan Karir Anda</h1>
                                <p class="text-lg mb-6 text-[#706f6c] dark:text-[#A1A09A]">Dapatkan pengalaman berharga melalui program magang di perusahaan terkemuka untuk mempersiapkan masa depan karir Anda.</p>
                                <div class="flex space-x-4">
                                    <a href="#jobs" class="inline-block px-6 py-3 bg-[#0E73B9] dark:bg-[#55B7E3] text-white rounded-md hover:bg-[#0a5a8f] dark:hover:bg-[#3a9fd0} transition duration-300">Mulai Sekarang</a>
                                </div>
                            </div>
                            <div class="md:w-1/2 animate__animated animate__fadeInRight">
                                <img src="https://via.placeholder.com/600x400" alt="Career Development" class="rounded-lg shadow-lg w-full">
                            </div>
                        </div>
                    </li>

                    <!-- Carousel Item 3 (Placeholder) -->
                     <li class="splide__slide">
                         <div class="flex flex-col md:flex-row items-center justify-between px-6 md:px-12 py-24 md:py-32 container mx-auto" style="min-height: 70vh;">
                            <div class="md:w-1/2 mb-8 md:mb-0 animate__animated animate__fadeInLeft">
                                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Temukan Peluang Terbaik</h1>
                                <p class="text-lg mb-6 text-[#706f6c] dark:text-[#A1A09A]">Jelajahi berbagai lowongan magang yang sesuai dengan minat dan kualifikasi Anda dari perusahaan mitra kami.</p>
                                <div class="flex space-x-4">
                                    <a href="#jobs" class="inline-block px-6 py-3 bg-[#0E73B9] dark:bg-[#55B7E3] text-white rounded-md hover:bg-[#0a5a8f] dark:hover:bg-[#3a9fd0} transition duration-300">Cari Sekarang</a>
                                </div>
                            </div>
                            <div class="md:w-1/2 animate__animated animate__fadeInRight">
                                <img src="https://via.placeholder.com/600x400?text=Slide+3" alt="Find Opportunities" class="rounded-lg shadow-lg w-full">
                            </div>
                        </div>
                    </li>

                     <!-- Carousel Item 4 (Placeholder) -->
                     <li class="splide__slide">
                         <div class="flex flex-col md:flex-row items-center justify-between px-6 md:px-12 py-24 md:py-32 container mx-auto" style="min-height: 70vh;">
                            <div class="md:w-1/2 mb-8 md:mb-0 animate__animated animate__fadeInLeft">
                                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Proses Seleksi yang Mudah</h1>
                                <p class="text-lg mb-6 text-[#706f6c] dark:text-[#A1A09A]">Ikuti alur seleksi yang transparan dan efisien melalui platform kami.</p>
                                <div class="flex space-x-4">
                                    <a href="#process" class="inline-block px-6 py-3 bg-[#0E73B9] dark:bg-[#55B7E3] text-white rounded-md hover:bg-[#0a5a8f] dark:hover:bg-[#3a9fd0} transition duration-300">Pelajari Prosesnya</a>
                                </div>
                            </div>
                            <div class="md:w-1/2 animate__animated animate__fadeInRight">
                                <img src="https://via.placeholder.com/600x400?text=Slide+4" alt="Selection Process" class="rounded-lg shadow-lg w-full">
                            </div>
                        </div>
                    </li>

                     <!-- Carousel Item 5 (Placeholder) -->
                     <li class="splide__slide">
                         <div class="flex flex-col md:flex-row items-center justify-between px-6 md:px-12 py-24 md:py-32 container mx-auto" style="min-height: 70vh;">
                            <div class="md:w-1/2 mb-8 md:mb-0 animate__animated animate__fadeInLeft">
                                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Dukungan Sepanjang Magang</h1>
                                <p class="text-lg mb-6 text-[#706f6c] dark:text-[#A1A09A]">Kami menyediakan fitur pelaporan dan komunikasi untuk mendukung Anda selama menjalani program magang.</p>
                                <div class="flex space-x-4">
                                    <a href="#support" class="inline-block px-6 py-3 bg-[#0E73B9] dark:bg-[#55B7E3] text-white rounded-md hover:bg-[#0a5a8f] dark:hover:bg-[#3a9fd0} transition duration-300">Dapatkan Dukungan</a>
                                </div>
                            </div>
                            <div class="md:w-1/2 animate__animated animate__fadeInRight">
                                <img src="https://via.placeholder.com/600x400?text=Slide+5" alt="Internship Support" class="rounded-lg shadow-lg w-full">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

             <!-- Default Splide.js arrows and dots will be generated here -->
        </div>
    </section>

    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide( '#hero-carousel', {
                type: 'loop',
                autoplay: true,
                interval: 5000,
                pauseOnHover: true,
                resetProgress: false,
                arrows: true,
                pagination: true,
            } ).mount();

            // Your existing mobile menu and user dropdown scripts
            // ... (ensure these are still here if needed)

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuLine1 = document.getElementById('menu-line-1');
            const menuLine2 = document.getElementById('menu-line-2');
            const menuLine3 = document.getElementById('menu-line-3');

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                // Animation for menu icon
                menuLine1.classList.toggle('rotate-45');
                menuLine1.classList.toggle('translate-y-2');
                menuLine2.classList.toggle('opacity-0');
                menuLine3.classList.toggle('-rotate-45');
                menuLine3.classList.toggle('-translate-y-2');
            });

            // Mobile dropdown toggle for Divisions
            const mobileDropdownButton = document.getElementById('mobile-dropdown-button');
            const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');
            const dropdownArrow = document.getElementById('dropdown-arrow');

            if(mobileDropdownButton) {
                mobileDropdownButton.addEventListener('click', () => {
                    mobileDropdownMenu.classList.toggle('hidden');
                    dropdownArrow.classList.toggle('rotate-180');
                });
            }

             // Mobile user dropdown toggle
             const mobileUserDropdownButton = document.getElementById('mobile-user-dropdown-button');
             const mobileUserDropdownMenu = document.getElementById('mobile-user-dropdown-menu');
             const userDropdownArrow = document.getElementById('user-dropdown-arrow');

             if(mobileUserDropdownButton) {
                 mobileUserDropdownButton.addEventListener('click', () => {
                     mobileUserDropdownMenu.classList.toggle('hidden');
                     userDropdownArrow.classList.toggle('rotate-180');
                 });
             }

             // Logout confirmation (if exists)
             window.showLogoutConfirmation = function(event) {
                 event.preventDefault();
                 if (confirm('Are you sure you want to log out?')) {
                     document.getElementById('logout-form').submit();
                 }
             }

              // Desktop notification dropdown toggle
              const notificationButton = document.getElementById('notification-button');
              const notificationDropdown = document.getElementById('notification-dropdown');

              if(notificationButton) {
                  notificationButton.addEventListener('click', () => {
                      notificationDropdown.classList.toggle('hidden');
                  });
                   // Close dropdown on click outside
                   document.addEventListener('click', (event) => {
                       if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                           notificationDropdown.classList.add('hidden');
                       }
                   });
              }

               // Desktop user menu dropdown toggle
               const userMenuButton = document.getElementById('user-menu-button');
               const userMenuDropdown = document.getElementById('user-menu-dropdown');

                if(userMenuButton) {
                   userMenuButton.addEventListener('click', () => {
                       userMenuDropdown.classList.toggle('hidden');
                   });
                   // Close dropdown on click outside
                   document.addEventListener('click', (event) => {
                       if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                           userMenuDropdown.classList.add('hidden');
                       }
                   });
                }


        });

</script>
</main> 