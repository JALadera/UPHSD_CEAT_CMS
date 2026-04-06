<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="University of Perpetual Help System DALTA - College of Engineering, Architecture, and Technology. Discover world-class engineering programs.">
    <title>{{ config('app.name') }} - UPH Engineering CMS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        
        .gradient-mesh {
            background: linear-gradient(-45deg, rgba(154, 52, 57, 0.05), rgba(255, 199, 0, 0.05), rgba(154, 52, 57, 0.03));
            background-size: 400% 400%;
            animation: mesh 15s ease infinite;
        }
        
        @keyframes mesh {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card-hover {
            @apply transition-all duration-500 hover:shadow-2xl hover:-translate-y-2;
        }

        .accent-line {
            @apply relative;
        }

        .accent-line::before {
            @apply absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-primary-500 to-maroon-600 transition-all duration-500 group-hover:w-full;
            content: '';
        }
    </style>
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Navigation -->
    <nav x-data="{ mobileOpen: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="scrolled ? 'bg-white/95 backdrop-blur-xl shadow-lg border-b border-gray-100/50' : 'bg-white/50 backdrop-blur-lg'"
        class="fixed top-0 w-full z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-br from-maroon-600 to-maroon-800 rounded-xl flex items-center justify-center text-white font-bold text-xs shadow-lg group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110">
                            UPH
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-primary-500 rounded-full border-2 border-white shadow-md"></div>
                    </div>
                    <div class="hidden sm:block">
                        <span class="font-bold text-maroon-800 text-sm tracking-tight">UPH Engineering</span>
                        <span class="block text-[10px] text-gray-500 font-semibold tracking-widest uppercase">CEAT</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-0.5">
                    <a href="{{ route('view.departments') }}" class="group relative px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-maroon-700 transition-colors">
                        Departments
                        <span class="accent-line"></span>
                    </a>
                    <a href="{{ route('view.programs') }}" class="group relative px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-maroon-700 transition-colors">
                        Programs
                        <span class="accent-line"></span>
                    </a>
                    <a href="{{ route('view.faculty') }}" class="group relative px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-maroon-700 transition-colors">
                        Faculty
                        <span class="accent-line"></span>
                    </a>
                    <a href="{{ route('view.research') }}" class="group relative px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-maroon-700 transition-colors">
                        Research
                        <span class="accent-line"></span>
                    </a>
                    <a href="{{ route('view.news') }}" class="group relative px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-maroon-700 transition-colors">
                        News
                        <span class="accent-line"></span>
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white rounded-xl font-semibold text-sm shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-maroon-700 font-semibold text-sm hover:bg-maroon-50 rounded-lg transition-colors duration-200">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-primary-500 to-primary-400 text-maroon-900 rounded-xl font-bold text-sm shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300">
                        Register
                    </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2.5 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileOpen" x-transition class="lg:hidden pb-6 border-t border-gray-100 mt-2 space-y-2">
                <a href="{{ route('view.departments') }}" class="block px-4 py-3 text-gray-700 hover:bg-maroon-50 hover:text-maroon-700 rounded-lg font-medium text-sm transition-colors">Departments</a>
                <a href="{{ route('view.programs') }}" class="block px-4 py-3 text-gray-700 hover:bg-maroon-50 hover:text-maroon-700 rounded-lg font-medium text-sm transition-colors">Programs</a>
                <a href="{{ route('view.faculty') }}" class="block px-4 py-3 text-gray-700 hover:bg-maroon-50 hover:text-maroon-700 rounded-lg font-medium text-sm transition-colors">Faculty</a>
                <a href="{{ route('view.research') }}" class="block px-4 py-3 text-gray-700 hover:bg-maroon-50 hover:text-maroon-700 rounded-lg font-medium text-sm transition-colors">Research</a>
                <a href="{{ route('view.news') }}" class="block px-4 py-3 text-gray-700 hover:bg-maroon-50 hover:text-maroon-700 rounded-lg font-medium text-sm transition-colors">News</a>
                <div class="pt-4 border-t border-gray-100 space-y-2">
                    @auth
                    <a href="{{ route('dashboard') }}" class="block text-center px-4 py-3 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white rounded-xl font-semibold text-sm">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="block text-center px-4 py-3 border-2 border-maroon-600 text-maroon-700 rounded-lg font-semibold text-sm">Sign In</a>
                    <a href="{{ route('register') }}" class="block text-center px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-400 text-maroon-900 rounded-xl font-bold text-sm">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen pt-32 pb-20 overflow-hidden gradient-mesh">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 rounded-full border border-primary-200">
                            <span class="w-2 h-2 bg-primary-600 rounded-full"></span>
                            <span class="text-sm font-semibold text-primary-700">Welcome to UPH Engineering</span>
                        </div>
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-gray-900 leading-tight">
                            Excellence in
                            <span class="block bg-gradient-to-r from-maroon-600 to-maroon-800 bg-clip-text text-transparent">Engineering</span>
                            Education
                        </h1>
                        <p class="text-lg sm:text-xl text-gray-600 max-w-xl leading-relaxed">
                            Discover world-class programs, distinguished faculty expertise, and cutting-edge research at the University of Perpetual Help System DALTA's College of Engineering, Architecture, and Technology.
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('view.departments') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-bold rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                            Explore Programs
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('view.news') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white border-2 border-gray-200 text-gray-900 font-bold rounded-xl hover:border-maroon-600 hover:bg-maroon-50 transition-all duration-300">
                            Latest News
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-8">
                        <div class="space-y-2">
                            <div class="text-3xl font-black text-maroon-700">8</div>
                            <p class="text-sm text-gray-600">Departments</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-3xl font-black text-maroon-700">10+</div>
                            <p class="text-sm text-gray-600">Programs</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-3xl font-black text-maroon-700">200+</div>
                            <p class="text-sm text-gray-600">Faculty</p>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="hidden lg:block relative h-[600px]">
                    <div class="absolute inset-0 bg-gradient-to-br from-maroon-600 to-maroon-800 rounded-3xl shadow-2xl"></div>
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-500/20 to-transparent rounded-3xl"></div>
                    <div class="absolute top-10 right-10 w-32 h-32 bg-white/10 rounded-2xl backdrop-blur-xl"></div>
                    <div class="absolute bottom-10 left-10 w-24 h-24 bg-white/10 rounded-2xl backdrop-blur-xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Departments Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-maroon-100 rounded-full text-sm font-bold text-maroon-700 mb-4">Featured Departments</span>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-6">
                    Core Engineering Departments
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Explore our comprehensive range of engineering disciplines designed to prepare the next generation of innovators.
                </p>
            </div>

            <!-- Departments Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">⚗</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Chemical Engineering</h3>
                    <p class="text-sm text-gray-600">Advanced chemical processes and research</p>
                </a>

                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">◻</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Civil Engineering</h3>
                    <p class="text-sm text-gray-600">Infrastructure and construction excellence</p>
                </a>

                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">⬢</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Computer Science</h3>
                    <p class="text-sm text-gray-600">Cutting-edge technology and innovation</p>
                </a>

                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Electrical Engineering</h3>
                    <p class="text-sm text-gray-600">Power systems and modern electronics</p>
                </a>

                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">◈</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Geodetic Engineering</h3>
                    <p class="text-sm text-gray-600">Precision mapping and surveying</p>
                </a>

                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">⚙</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Industrial Engineering</h3>
                    <p class="text-sm text-gray-600">Process optimization and efficiency</p>
                </a>

                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">◆</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Mechanical Engineering</h3>
                    <p class="text-sm text-gray-600">Mechanical systems and design</p>
                </a>

                <a href="{{ route('view.departments') }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600">
                    <div class="text-4xl mb-4">▲</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Mining & Materials</h3>
                    <p class="text-sm text-gray-600">Materials science and research</p>
                </a>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('view.departments') }}" class="inline-flex items-center px-8 py-3 text-maroon-700 font-bold border-2 border-maroon-600 rounded-xl hover:bg-maroon-50 transition-colors duration-300">
                    View All Departments →
                </a>
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary-100 rounded-full text-sm font-bold text-primary-700 mb-4">Stay Updated</span>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-6">
                    Latest News & Events
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Keep informed about important announcements and upcoming events in UPH Engineering.
                </p>
            </div>

            <!-- News Cards -->
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gradient-to-br from-maroon-600 to-maroon-800 flex items-center justify-center">
                            <div class="text-6xl">▬</div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-maroon-100 text-maroon-700 rounded-full text-xs font-bold mb-3">News</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-700">New Engineering Lab Opens</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">State-of-the-art robotics and AI laboratory now available for student research.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                            <div class="text-6xl">▬</div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-bold mb-3">Event</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Annual Engineering Symposium</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">Join industry leaders for the 25th annual Engineering Symposium.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gradient-to-br from-maroon-700 to-maroon-900 flex items-center justify-center">
                            <div class="text-6xl">▬</div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-maroon-100 text-maroon-700 rounded-full text-xs font-bold mb-3">Research</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Faculty Publication Highlight</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">Dr. Maria Santos publishes groundbreaking research on sustainable materials.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="text-center">
                <a href="{{ route('view.news') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-bold rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-300">
                    View All News →
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-maroon-700 via-maroon-600 to-maroon-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-black text-white mb-6 leading-tight">
                Ready to Start Your Engineering Journey?
            </h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                Join thousands of students and become part of UPH Engineering's legacy of excellence.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-primary-500 text-maroon-900 font-bold rounded-xl hover:bg-primary-400 hover:scale-105 transition-all duration-300 shadow-lg">
                    Enroll Now
                </a>
                <a href="{{ route('view.programs') }}" class="px-8 py-4 bg-white/10 text-white font-bold rounded-xl hover:bg-white/20 transition-all duration-300 border border-white/30">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-maroon-600 to-maroon-800 rounded-xl flex items-center justify-center text-white font-bold text-xs">UPH</div>
                        <span class="font-bold text-white">UPH Engineering</span>
                    </div>
                    <p class="text-sm text-gray-400">College of Engineering, Architecture, and Technology</p>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="font-bold text-white text-sm uppercase tracking-wider">Programs</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('view.programs') }}" class="hover:text-white transition-colors">All Programs</a></li>
                        <li><a href="{{ route('view.departments') }}" class="hover:text-white transition-colors">Departments</a></li>
                        <li><a href="{{ route('view.faculty') }}" class="hover:text-white transition-colors">Faculty</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="space-y-4">
                    <h3 class="font-bold text-white text-sm uppercase tracking-wider">Resources</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('view.research') }}" class="hover:text-white transition-colors">Research Centers</a></li>
                        <li><a href="{{ route('view.news') }}" class="hover:text-white transition-colors">News & Events</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Admissions</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-4">
                    <h3 class="font-bold text-white text-sm uppercase tracking-wider">Contact</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">✉ info@uphsd.edu.ph</li>
                        <li class="flex items-center gap-2">☎ +63 2 8xxx xxxx</li>
                        <li class="flex items-center gap-2">◉ Las Piñas, Manila</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                    <p>&copy; 2024 UPH Engineering CMS. All rights reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-white transition-colors">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
