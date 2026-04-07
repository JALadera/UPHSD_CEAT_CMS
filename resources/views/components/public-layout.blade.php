<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'University of Perpetual Help System DALTA - College of Engineering, Architecture, and Technology' }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <title>{{ $title ?? config('app.name') }} | UPH Engineering</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900 custom-scrollbar">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav x-data="{ mobileOpen: false, scrolled: false }"
             x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
             :class="scrolled ? 'bg-white/95 backdrop-blur-xl shadow-lg border-b border-gray-100/50' : 'bg-white/50 backdrop-blur-lg'"
             class="fixed top-0 z-50 w-full transition-all duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 lg:h-18">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="relative">
                            <div class="w-10 h-10 bg-gradient-to-br from-maroon-500 to-maroon-700 rounded-xl flex items-center justify-center text-white font-bold text-xs shadow-md group-hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                UPH
                            </div>
                            <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-primary-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="hidden sm:block">
                            <span class="font-bold text-maroon-700 text-sm tracking-tight">UPH Engineering</span>
                            <span class="block text-[10px] text-gray-400 font-medium tracking-wider uppercase">CEAT</span>
                        </div>
                    </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center gap-1">
                        <a href="{{ route('view.departments') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-maroon-600 hover:bg-maroon-50 rounded-lg transition-all duration-200 {{ request()->routeIs('view.departments*') ? 'text-maroon-600 bg-maroon-50' : '' }}">
                            Departments
                        </a>
                        <a href="{{ route('view.programs') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-maroon-600 hover:bg-maroon-50 rounded-lg transition-all duration-200 {{ request()->routeIs('view.programs*') ? 'text-maroon-600 bg-maroon-50' : '' }}">
                            Programs
                        </a>
                        <a href="{{ route('view.faculty') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-maroon-600 hover:bg-maroon-50 rounded-lg transition-all duration-200 {{ request()->routeIs('view.faculty*') ? 'text-maroon-600 bg-maroon-50' : '' }}">
                            Faculty
                        </a>

                        <a href="{{ route('view.news') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-maroon-600 hover:bg-maroon-50 rounded-lg transition-all duration-200 {{ request()->routeIs('view.news*') ? 'text-maroon-600 bg-maroon-50' : '' }}">
                            News
                        </a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="hidden lg:flex items-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-gradient-to-r from-maroon-500 to-maroon-600 text-white rounded-xl hover:from-maroon-600 hover:to-maroon-700 transition-all duration-300 text-sm font-semibold shadow-md hover:shadow-lg hover:scale-[1.02]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-maroon-600 hover:text-maroon-700 transition-colors text-sm font-semibold">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-primary-500 to-primary-400 text-maroon-900 rounded-xl hover:from-primary-400 hover:to-primary-300 transition-all duration-300 text-sm font-bold shadow-md hover:shadow-lg hover:scale-[1.02]">
                                Register
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Navigation -->
                <div x-show="mobileOpen" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="lg:hidden pb-4 border-t border-gray-100 mt-2">
                    <div class="pt-4 space-y-1">
                        <a href="{{ route('view.departments') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-maroon-50 hover:text-maroon-600 font-medium transition-colors">Departments</a>
                        <a href="{{ route('view.programs') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-maroon-50 hover:text-maroon-600 font-medium transition-colors">Programs</a>
                        <a href="{{ route('view.faculty') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-maroon-50 hover:text-maroon-600 font-medium transition-colors">Faculty</a>

                        <a href="{{ route('view.news') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-maroon-50 hover:text-maroon-600 font-medium transition-colors">News & Events</a>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 space-y-2 px-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-3 bg-maroon-500 text-white rounded-xl font-semibold">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 border-2 border-maroon-500 text-maroon-600 rounded-xl font-semibold">Sign In</a>
                            <a href="{{ route('register') }}" class="block w-full text-center px-4 py-3 bg-primary-500 text-maroon-900 rounded-xl font-bold">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-gray-400 relative overflow-hidden">
            <!-- Decorative top border -->
            <div class="h-1 bg-gradient-to-r from-maroon-500 via-primary-500 to-maroon-500"></div>

            <!-- Decorative shapes -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-maroon-500/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary-500/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-12 mb-12">
                    <!-- Brand -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-maroon-500 to-maroon-700 rounded-xl flex items-center justify-center text-white font-bold text-xs shadow-lg">
                                UPH
                            </div>
                            <div>
                                <span class="font-bold text-white text-lg">UPH Engineering</span>
                                <span class="block text-xs text-gray-500 tracking-wider uppercase">College of Engineering</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                            Building the future through excellence in engineering education and community service.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Academic</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('view.departments') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-maroon-500"></span>Departments</a></li>
                            <li><a href="{{ route('view.programs') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-maroon-500"></span>Programs</a></li>
                            <li><a href="{{ route('view.faculty') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-maroon-500"></span>Faculty</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Resources</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('view.news') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-primary-500"></span>News & Events</a></li>

                            <li><a href="#" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-primary-500"></span>Support</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Contact</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-maroon-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                info@uphsd.edu.ph
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-maroon-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                +63 2 8xxx xxxx
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-maroon-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Las Piñas, Manila
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="border-t border-gray-800 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                        <p class="text-gray-500">© {{ date('Y') }} University of Perpetual Help System DALTA. All rights reserved.</p>
                        <div class="flex gap-6">
                            <a href="#" class="text-gray-500 hover:text-primary-400 transition-colors">Privacy Policy</a>
                            <a href="#" class="text-gray-500 hover:text-primary-400 transition-colors">Terms</a>
                            <a href="#" class="text-gray-500 hover:text-primary-400 transition-colors">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
