<nav x-data="{ open: false, dropdownOpen: false }" class="bg-gray-800 text-white shadow-md sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:flex">
                <a href="{{ route('dashboard') }}" 
                   class="text-lg font-semibold {{ request()->routeIs('dashboard') ? 'text-green-400' : 'hover:text-green-300' }}">
                    Store
                </a>
            </div>



            <!-- Cart/Shopping Link -->
            <div>
                @if (request()->is('cart'))
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-2 text-lg font-semibold hover:text-green-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M9 3v12m6-12v12M4 6h16M4 12h16m-10 6h4" />
                        </svg>
                        <span>Continue Shopping</span>
                    </a>
                @else
                    <a href="/cart" 
                       class="flex items-center space-x-2 text-lg font-semibold hover:text-green-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M9 3v12m6-12v12M4 6h16M4 12h16m-10 6h4" />
                        </svg>
                        <span>Cart</span>
                    </a>
                @endif
            </div>

            <!-- User Settings Dropdown -->
            <div class="hidden sm:flex items-center space-x-4">
                <div class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" 
                            class="flex items-center space-x-2 bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg">
                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" 
                         class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger Menu -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="bg-gray-700 hover:bg-gray-600 p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Dashboard</a>
        </div>
    </div>
</nav>
