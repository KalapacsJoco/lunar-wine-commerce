<nav class="sticky top-0 z-50 bg-white border-gray-200 dark:bg-gray-900 shadow-md">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Store Link -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white {{ request()->routeIs('dashboard') ? 'text-blue-700' : 'hover:text-blue-500' }}">
                Store
            </span>
        </a>

        <!-- Mobile Menu Button -->
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        <!-- Navigation Links -->
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                <!-- Guest Links -->
                @guest
                <li>
                    <livewire:register-modal />
                </li>
                <li>
                    <livewire:login-modal />
                </li>
                @endguest

                <!-- Authenticated Links -->
                @auth
                <li class="flex items-center">
                    <!-- Cart Link -->
                    @unless (request()->is('cart'))
                    <div x-data="{ cartTotal: 0 }" @cart-updated.window="cartTotal = $event.detail.total">
                        <a href="/cart" class="flex items-center space-x-2 text-lg font-semibold text-gray-900 hover:text-blue-700 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path d="M7 18c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-9.142-1h8.658c.721 0 1.322-.5 1.474-1.197l2.71-10.803c.038-.151.057-.307.057-.462 0-.827-.673-1.5-1.5-1.5H5.594l-.354-1.732A1.498 1.498 0 0 0 3.763 1H1v2h2.763l2.92 14.682A2.984 2.984 0 0 0 7 21c1.654 0 3-1.346 3-3h-2c0 .551-.449 1-1 1s-1-.449-1-1 .449-1 1-1z" />
                            </svg>
                            <span>Cart (<span x-text="cartTotal"></span>)</span>
                        </a>
                    </div>
                    @endunless
                </li>

                <li>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-lg font-semibold text-red-600 hover:text-red-400 dark:text-red-400">
                            Logout
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
