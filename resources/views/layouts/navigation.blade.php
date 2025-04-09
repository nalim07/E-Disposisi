<nav x-data="{ open: false }" class="bg-primary border-b border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-start pr-3 py-2 border-r-2 text-sm leading-4 font-medium text-white gap-2 focus:outline-none transition ease-in-out duration-150">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <span>{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Beranda - Tampil untuk semua role -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    @role('admin')
                        <!-- Menu Admin -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="inline-flex items-center px-1 mt-6 pb-5 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none {{ request()->routeIs(['surat-masuk', 'surat-keluar']) ? 'border-white text-white focus:border-grey-200' : 'border-transparent text-gray-200 hover:text-white hover:border-gray-300 focus:text-gray-200 focus:border-gray-300' }}">
                                {{ __('Transaksi Surat') }}
                            </button>

                            <!-- Dropdown Content -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-left">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white py-2">
                                    @can('view_surat-masuk')
                                        <x-dropdown-link :href="route('surat-masuk.index')" :active="request()->routeIs('surat-masuk.index')" class="block px-4 py-2 text-sm text">
                                            {{ __('Surat Masuk') }}
                                        </x-dropdown-link>
                                    @endcan

                                    @can('view_surat-keluar')
                                        <x-dropdown-link :href="route('surat-keluar')" :active="request()->routeIs('surat-keluar')" class="block px-4 py-2 text-sm">
                                            {{ __('Surat Keluar') }}
                                        </x-dropdown-link>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        @can('view_arsip')
                            <x-nav-link :href="route('arsip')" :active="request()->routeIs('arsip')">
                                {{ __('Arsip') }}
                            </x-nav-link>
                        @endcan
                    @else
                        <!-- Menu untuk Pimpinan & Pegawai -->
                        @can('view_surat-masuk')
                            <x-nav-link :href="route('surat-masuk.index')" :active="request()->routeIs('surat-masuk')">
                                {{ __('Surat Masuk') }}
                            </x-nav-link>
                        @endcan

                        @can('view_disposisi')
                            <x-nav-link :href="route('disposisi')" :active="request()->routeIs('disposisi')">
                                {{ __('Disposisi') }}
                            </x-nav-link>
                        @endcan
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-200 focus:outline-non gap-2 transition ease-in-out duration-150">
                            <x-user-logo class="block h-8 w-auto fill-current text-gray-800" />
                            <div>{{ Auth::user()->username }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
