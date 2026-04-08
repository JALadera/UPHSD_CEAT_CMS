<!-- Multi-level Navigation Component -->
<nav x-data="navigationMenu()" 
     @scroll.window="isScrolled = window.scrollY > 100"
     :style="`position: fixed; top: 0; z-index: 50; width: 100%; transition: all 0.3s ease; ${isScrolled ? 'background: linear-gradient(135deg, rgba(127, 20, 22, 0.95) 0%, rgba(127, 20, 22, 0.85) 100%); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25); border-bottom: 1px solid rgba(255, 255, 255, 0.1);' : 'background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(127, 20, 22, 0.1);'}`">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-auto lg:h-24 py-4 lg:py-2 flex-wrap lg:flex-nowrap gap-4 lg:gap-0">
            
            <!-- Logo Section -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                <img src="{{ asset('images/coe-logo.png') }}" alt="CEAT Logo" class="h-16 w-auto group-hover:scale-110 transition-transform duration-300">
                <div class="hidden sm:block">
                    <h1 :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" class="font-bold text-sm lg:text-base tracking-tight leading-tight transition-colors duration-300">COLLEGE OF ENGINEERING,</h1>
                    <h1 :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" class="font-bold text-sm lg:text-base tracking-tight leading-tight transition-colors duration-300">ARCHITECTURE & TECHNOLOGY</h1>
                </div>
            </a>

            <!-- Desktop Menu with Dropdowns -->
            <div class="hidden lg:flex items-center gap-1 flex-1 justify-center" style="font-family: 'Inter', 'Segoe UI', sans-serif;">
                @foreach($navigationItems as $itemKey => $item)
                    @if($item['hasDropdown'])
                        <!-- Dropdown Menu Item -->
                        <div @mouseenter="openDropdown('{{ $itemKey }}')" 
                             @mouseleave="closeDropdown()" 
                             class="relative group">
                            <button :style="`transition: all 0.3s ease; ${isScrolled ? 'color: white;' : 'color: #7f1416;'}`" 
                                    style="font-weight: 500; font-size: 14px; padding: 12px 16px; display: inline-flex; align-items: center; gap: 4px; letter-spacing: 0.3px; border-radius: 6px;"
                                    :class="[
                                        isScrolled ? 'hover:bg-white/20 hover:shadow-lg' : 'hover:shadow-2xl hover:bg-gray-100',
                                        activeDropdown === '{{ $itemKey }}' ? (isScrolled ? 'bg-white/20' : 'bg-gray-100') : ''
                                    ]">
                                {{ $item['label'] }}
                                <svg class="w-4 h-4 transition-transform duration-300" 
                                     :class="activeDropdown === '{{ $itemKey }}' ? 'rotate-180' : ''" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </button>
                            
                            <!-- Dropdown Content -->
                            <div x-show="activeDropdown === '{{ $itemKey }}'" 
                                 x-transition 
                                 @click.away="closeDropdown()"
                                 class="absolute left-0 mt-0 w-48 rounded-lg shadow-2xl overflow-hidden"
                                 :style="`${isScrolled ? 'background: linear-gradient(135deg, rgba(127, 20, 22, 0.98) 0%, rgba(127, 20, 22, 0.95) 100%);' : 'background: white; border: 1px solid rgba(127, 20, 22, 0.1);'}`">
                                
                                @foreach($item['items'] as $subItem)
                                    <a href="{{ $subItem['url'] }}" 
                                       :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'}`"
                                       class="block px-4 py-3 text-sm font-medium transition-all duration-200"
                                       :class="[
                                           isScrolled ? 'hover:bg-white/20' : 'hover:bg-gray-50',
                                           'border-l-4 border-transparent hover:border-primary-500'
                                       ]">
                                        {{ $subItem['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Single Link -->
                        <a href="{{ $item['url'] }}" 
                           :style="`transition: all 0.3s ease; ${isScrolled ? 'color: white;' : 'color: #7f1416;'}`" 
                           style="font-weight: 500; font-size: 14px; padding: 12px 16px; display: inline-block; letter-spacing: 0.3px; border-radius: 6px;"
                           :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg' : 'hover:shadow-2xl hover:bg-gray-100'">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!-- Auth Buttons (right side) -->
            <div class="hidden lg:flex items-center gap-3 ml-auto">
                @auth
                    <a href="{{ route('dashboard') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 10px 20px; display: inline-block; border-radius: 6px; transition: all 0.3s ease;" class="hover:shadow-lg hover:shadow-yellow-400 hover:scale-105">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 600; font-size: 14px; padding: 10px 16px; display: inline-block;" :class="isScrolled ? 'hover:bg-white/20 hover:rounded-lg hover:scale-105' : 'hover:shadow-2xl hover:rounded-lg hover:scale-105'">Sign In</a>
                    <a href="{{ route('register') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 10px 20px; display: inline-block; border-radius: 6px; transition: all 0.3s ease;" class="hover:shadow-lg hover:shadow-yellow-400 hover:scale-105">Register</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2.5 rounded-lg" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="transition-colors duration-300;">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu with Collapsible Dropdowns -->
        <div x-show="mobileOpen" x-transition class="lg:hidden w-full pb-4" :style="isScrolled ? 'border-top: 1px solid rgba(255, 255, 255, 0.1); color: white;' : 'border-top: 1px solid rgba(127, 20, 22, 0.1); color: #7f1416;'" style="font-family: 'Inter', 'Segoe UI', sans-serif;">
            
            @foreach($navigationItems as $itemKey => $item)
                @if($item['hasDropdown'])
                    <!-- Mobile Dropdown -->
                    <div>
                        <button @click="toggleMobileDropdown('{{ $itemKey }}')" 
                                :style="isScrolled ? 'color: white;' : 'color: #7f1416;'"
                                class="w-full text-left flex items-center justify-between py-3 px-4 border-b border-opacity-10"
                                :class="isScrolled ? 'border-white' : 'border-maroon-500'">
                            <span style="font-weight: 500; font-size: 14px;">{{ $item['label'] }}</span>
                            <svg class="w-4 h-4 transition-transform duration-300" 
                                 :class="openMobileDropdowns['{{ $itemKey }}'] ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>
                        
                        <!-- Mobile Dropdown Items -->
                        <div x-show="openMobileDropdowns['{{ $itemKey }}']" x-transition>
                            @foreach($item['items'] as $subItem)
                                <a href="{{ $subItem['url'] }}" 
                                   :style="isScrolled ? 'color: white;' : 'color: #7f1416;'"
                                   class="block py-2 px-8 text-sm font-medium border-l-4 border-primary-500 transition-all duration-200"
                                   :class="isScrolled ? 'hover:bg-white/10' : 'hover:bg-gray-50'">
                                    {{ $subItem['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Mobile Single Link -->
                    <a href="{{ $item['url'] }}" 
                       :style="isScrolled ? 'color: white;' : 'color: #7f1416;'"
                       class="block py-3 px-4 text-sm font-medium border-b border-opacity-10 transition-all duration-200"
                       :class="[isScrolled ? 'border-white hover:bg-white/10' : 'border-maroon-500 hover:bg-gray-50']">
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach

            <!-- Mobile Auth Section -->
            <div :style="isScrolled ? 'padding-top: 16px; border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: 16px;' : 'padding-top: 16px; border-top: 1px solid rgba(127, 20, 22, 0.1); margin-top: 16px;'" style="display: flex; flex-direction: column; gap: 8px;">
                @auth
                    <a href="{{ route('dashboard') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 12px 16px; display: block; text-align: center; border-radius: 6px;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="font-weight: 600; font-size: 14px; padding: 12px 16px; display: block; text-align: center; border-radius: 6px; transition-colors duration-300;">Sign In</a>
                    <a href="{{ route('register') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 12px 16px; display: block; text-align: center; border-radius: 6px;">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Alpine.js Navigation Controller -->
<script>
function navigationMenu() {
    return {
        mobileOpen: false,
        isScrolled: false,
        activeDropdown: null,
        openMobileDropdowns: {},
        
        openDropdown(name) {
            this.activeDropdown = name;
        },
        
        closeDropdown() {
            this.activeDropdown = null;
        },
        
        toggleMobileDropdown(name) {
            this.$nextTick(() => {
                this.openMobileDropdowns[name] = !this.openMobileDropdowns[name];
            });
        }
    };
}
</script>
