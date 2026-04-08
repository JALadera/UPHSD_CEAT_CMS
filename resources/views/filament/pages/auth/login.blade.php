<x-filament-panels::page.simple>
    <x-slot name="logo">
        <div class="flex flex-col items-center gap-3">
            <div class="w-16 h-16 bg-gradient-to-br from-maroon-500 to-maroon-700 rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-xl">
                UPH
            </div>
            <div class="text-center">
                <span class="block font-bold text-maroon-700 text-lg">College of Engineering</span>
                <span class="block text-xs text-gray-400 tracking-wider uppercase">Admin Portal</span>
            </div>
        </div>
    </x-slot>

    {{ $this->form }}

    <div class="text-center mt-6">
        <a href="{{ route('home') }}"
            class="text-sm text-gray-600 hover:text-maroon-600 transition-colors font-medium">
            ← Back to Website
        </a>
    </div>
</x-filament-panels::page.simple>
