<nav x-data="{ open: false }" id="mainNavbar"
     class="bg-gray-900 border-b border-gray-100 fixed top-0 left-0 w-full z-50 transition-all duration-300 ease-in-out">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative flex h-20 items-center justify-between">
            <div class="flex items-center justify-start space-x-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center shrink-0">
                    <img src="{{ asset('images/mindcarelogo.png') }}" alt="MindCareHub Logo" class="h-10 w-auto">
                </a>

                <!-- Navigation Links (hidden on mobile) -->
                <div class="hidden md:flex md:space-x-8 md:ml-10">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="rounded-md py-2 text-sm font-medium text-white hover:text-white uppercase">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('counselors')" :active="request()->routeIs('counselors')" class="rounded-md py-2 text-sm font-medium text-white hover:text-white uppercase">
                        {{ __('Counselors') }}
                    </x-nav-link>
                    <x-nav-link :href="route('mood_predictor')" :active="request()->routeIs('mood_predictor')" class="rounded-md py-2 text-sm font-medium text-white hover:text-white uppercase">
                        {{ __('Mood Predictor') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blogs')" :active="request()->routeIs('blogs')" class="rounded-md py-2 text-sm font-medium text-white hover:text-white uppercase">
                        {{ __('Blog') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="rounded-md py-2 text-sm font-medium text-white hover:text-white uppercase">
                        {{ __('About') }}
                    </x-nav-link>
                    @guest
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="rounded-md py-2 text-sm font-medium text-white hover:text-white uppercase">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="rounded-md py-2 text-sm font-medium text-white hover:text-white uppercase">
                            {{ __('Register') }}
                        </x-nav-link>
                    @endguest
                </div>
            </div>

            <!-- Settings Dropdown (hidden on mobile) -->
            <div class="hidden md:flex md:items-center md:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 text-sm font-medium uppercase"
                        >
                            <div class="font-medium text-base text-gray-800">
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Guest
                                @endauth
                            </div>

                            <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @php
                            $user = Auth::user();
                            $email = $user->email ?? '';
                        @endphp

                        @if ($email === 'admin@mindcare.com')
                            <x-dropdown-link href="{{ route('dashboard') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 uppercase">
                                Admin Dashboard
                            </x-dropdown-link>
                        @elseif (Auth::guard('web')->check())
                            <x-dropdown-link href="{{ route('user.dashboard') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 uppercase">
                                Dashboard
                            </x-dropdown-link>
                        @elseif (Auth::guard('counselor')->check())
                            <x-dropdown-link href="{{ route('counselor.dashboard') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 uppercase">
                                Counselor Dashboard
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 uppercase"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (shown on mobile) -->
            <div class="flex items-center md:hidden">
                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    aria-label="Toggle menu"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden bg-gray-900 border-t border-gray-700">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('counselors')" :active="request()->routeIs('counselors')">
                {{ __('Counselors') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('mood_predictor')" :active="request()->routeIs('mood_predictor')">
                {{ __('Mood Predictor') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blogs')" :active="request()->routeIs('blogs')">
                {{ __('Blog') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About') }}
            </x-responsive-nav-link>
            @guest
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endguest
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700 px-4">
            <div class="font-medium text-base text-white">
                @auth
                    {{ Auth::user()->name }}
                @else
                    Guest
                @endauth
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
