@php
    $version = implode('.', Config::get('app.version'));
@endphp

<nav x-data="{ open: false }" class="bg-light-bg-secondary dark:bg-dark-bg-secondary border-b border-light-accent dark:border-dark-accent text-light-text-primary dark:text-dark-text-primary">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-light-text dark:text-dark-text transition ease-in-out delay-150 hover:scale-110 duration-300" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('app.home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('home')" :active="request()->routeIs('medical-reports.*')">
                        {{ __('medical-reports.name') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="grow"></div>

            <!-- Theme selector -->
            <div class="flex w-10 sm:w-10 items-center">
                <div id="dark-icon" class="p-2 sm:p-0 rounded-md tooltip sm:flex-col dark:hover:bg-dark-bg-primary
                sm:dark:hover:bg-dark-bg-secondary">
                    <button 
                        class="h-6 dark:text-dark-text-primary sm:dark:text-dark-text-secondary sm:dark:hover:text-dark-text-primary focus:outline-none transition duration-150 ease-in-out" 
                        onclick="switchTheme('system')">
                        <x-icons.moon class="" />
                    </button>
                    <div class="hidden sm:block tooltip-text text-xs bg-dark-bg-primary text-dark-text-primary">Zmień wyglad na systemowy</div>
                </div>
                <div id="light-icon" class="p-2 sm:p-0 rounded-md hidden tooltip sm:flex-col hover:bg-light-bg-primary sm:hover:bg-light-bg-secondary">
                    <button 
                        class="h-7 text-light-text-primary sm:text-light-text-secondary sm:hover:text-light-text-primary focus:outline-none transition duration-150 ease-in-out" 
                        onclick="switchTheme('dark')">
                            <x-icons.sun class="" />
                    </button>
                    <span class="hidden sm:block tooltip-text text-xs bg-light-bg-primary text-light-text-primary">Zmień wyglad na ciemny</span>
                </div>
                <div id="system-icon" class="p-2 sm:p-0 rounded-md hidden tooltip sm:flex-col hover:bg-light-bg-primary sm:hover:bg-light-bg-secondary dark:hover:bg-dark-bg-primary
                sm:dark:hover:bg-dark-bg-secondary">
                    <button 
                        class="h-7 text-xs text-light-text-primary dark:text-dark-text-primary sm:text-light-text-secondary sm:dark:text-dark-text-secondary sm:hover:text-light-text-primary sm:dark:hover:text-dark-text-primary focus:outline-none transition duration-150 ease-in-out" 
                        onclick="switchTheme('light')">
                            <x-icons.system-theme class="" />
                    </button>
                    <div class="hidden sm:block tooltip-text text-xs bg-light-bg-primary text-light-text-primary dark:bg-dark-bg-primary dark:text-dark-text-primary">Zmień wyglad na jasny</div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-light-text-secondary dark:text-dark-text-secondary hover:text-light-text-primary dark:hover:text-dark-text-primary focus:outline-none transition duration-150 ease-in-out">
                            <div class="h-7">
                                <x-icons.user-circle class=""/>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <div class="pt-4 pb-2 border-b border-light-text-secondary dark:border-dark-text-secondary">
                            <div class="flex justify-center font-medium text-base text-light-text-primary dark:text-dark-text-primary">
                                {{ Auth::user()->firstname }}
                            </div>
                            <div class="flex justify-center font-medium text-sm text-light-text-secondary dark:text-dark-text-secondary">
                                {{ Auth::user()->email }}
                            </div>
                            <div class="flex justify-end px-2 pt-4 text-xs text-dark-text-secondary dark:text-light-text-secondary">
                                {{ $version }}
                            </div>
                        </div>
                        <div class="pt-2">
                            {{-- <x-dropdown-link :href="route('user.show', Crypt::encryptString(Auth::user()->id))"> --}}
                            <x-dropdown-link>
                                {{ __('app.user.settings') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('auth.logout') }}
                                </x-dropdown-link>
                            </form>
                        </div>  
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
            </div>
        </div>
    </div>



</nav>