<nav x-data="{ open: false }" class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/services/logo.png') }}" class="h-32 w-auto" alt="Sensory Logo">
                </a>
            </div>

            <!-- Navigation Links 
            
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link> -->
                <div class="hidden sm:flex sm:items-center sm:space-x-6">

                <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                    {{ __('All Services') }}
                </x-nav-link>
                <x-nav-link :href="route('favourites.index')" :active="request()->routeIs('favourites.index')">
                    {{ __('My Favourites') }}
                </x-nav-link>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('services.create')" :active="request()->routeIs('services.create')">
                            {{ __('Create Service') }}
                        </x-nav-link>
                    @endif
                @endauth
            </div>

            <!-- User/Admin Buttons -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @auth
                    <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-[#9773B3] hover:bg-purple-700 text-white px-4 py-2 rounded transition">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-[#9773B3] hover:bg-purple-700 text-white px-4 py-2 rounded transition">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                        class="border border-[#9773B3] text-[#9773B3] hover:bg-purple-100 px-4 py-2 rounded transition">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                {{ __('All Services') }}
            </x-responsive-nav-link>

            @auth
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('services.create')" :active="request()->routeIs('services.create')">
                        {{ __('Create Service') }}
                    </x-responsive-nav-link>
                @endif
                <div class="border-t border-gray-200 pt-4">
                    <div class="px-4 text-gray-800 font-medium">{{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="w-full bg-[#9773B3] hover:bg-purple-700 text-white px-4 py-2 rounded transition">
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-4 pb-1 space-y-2">
                    <a href="{{ route('login') }}"
                        class="block text-center w-full bg-[#9773B3] hover:bg-purple-700 text-white px-4 py-2 rounded transition">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                        class="block text-center w-full border border-[#9773B3] text-[#9773B3] hover:bg-purple-100 px-4 py-2 rounded transition">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>