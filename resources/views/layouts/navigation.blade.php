<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links selon rôle -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(auth()->user()->role === 'doyen')
                            <x-nav-link :href="route('doyen.dashboard')" :active="request()->routeIs('doyen.dashboard')">
                                Tableau de bord
                            </x-nav-link>
                            <x-nav-link :href="route('doyen.utilisateurs')" :active="request()->routeIs('doyen.utilisateurs')">
                                Utilisateurs
                            </x-nav-link>
                            <x-nav-link :href="route('doyen.conventions')" :active="request()->routeIs('doyen.conventions')">
                                Conventions
                            </x-nav-link>

                        @elseif(auth()->user()->role === 'chef_filiere')
                            <x-nav-link :href="route('chef.dashboard')" :active="request()->routeIs('chef.dashboard')">
                                Tableau de bord
                            </x-nav-link>
                            <x-nav-link :href="route('chef.demandes')" :active="request()->routeIs('chef.demandes')">
                                Demandes de stage
                            </x-nav-link>
                            <x-nav-link :href="route('chef.conventions')" :active="request()->routeIs('chef.conventions')">
                                Conventions
                            </x-nav-link>

                        @elseif(auth()->user()->role === 'etudiant')
                            <x-nav-link :href="route('etudiant.dashboard')" :active="request()->routeIs('etudiant.dashboard')">
                                Tableau de bord
                            </x-nav-link>
                            <x-nav-link :href="route('etudiant.demande')" :active="request()->routeIs('etudiant.demande')">
                                Demande de stage
                            </x-nav-link>
                            <x-nav-link :href="route('etudiant.convention')" :active="request()->routeIs('etudiant.convention')">
                                Ma convention
                            </x-nav-link>
                            <x-nav-link :href="route('etudiant.rapport')" :active="request()->routeIs('etudiant.rapport')">
                                Mon rapport
                            </x-nav-link>

                        @elseif(auth()->user()->role === 'encadrant')
                            <x-nav-link :href="route('encadrant.dashboard')" :active="request()->routeIs('encadrant.dashboard')">
                                Tableau de bord
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent
                            text-sm leading-4 font-medium rounded-md text-gray-500 bg-white
                            hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger menu mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2
                    rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100
                    focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->role === 'doyen')
                    <x-responsive-nav-link :href="route('doyen.dashboard')" :active="request()->routeIs('doyen.dashboard')">
                        Tableau de bord
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('doyen.utilisateurs')" :active="request()->routeIs('doyen.utilisateurs')">
                        Utilisateurs
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('doyen.conventions')" :active="request()->routeIs('doyen.conventions')">
                        Conventions
                    </x-responsive-nav-link>

                @elseif(auth()->user()->role === 'chef_filiere')
                    <x-responsive-nav-link :href="route('chef.dashboard')" :active="request()->routeIs('chef.dashboard')">
                        Tableau de bord
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('chef.demandes')" :active="request()->routeIs('chef.demandes')">
                        Demandes de stage
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('chef.conventions')" :active="request()->routeIs('chef.conventions')">
                        Conventions
                    </x-responsive-nav-link>

                @elseif(auth()->user()->role === 'etudiant')
                    <x-responsive-nav-link :href="route('etudiant.dashboard')" :active="request()->routeIs('etudiant.dashboard')">
                        Tableau de bord
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('etudiant.demande')" :active="request()->routeIs('etudiant.demande')">
                        Demande de stage
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('etudiant.convention')" :active="request()->routeIs('etudiant.convention')">
                        Ma convention
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('etudiant.rapport')" :active="request()->routeIs('etudiant.rapport')">
                        Mon rapport
                    </x-responsive-nav-link>

                @elseif(auth()->user()->role === 'encadrant')
                    <x-responsive-nav-link :href="route('encadrant.dashboard')" :active="request()->routeIs('encadrant.dashboard')">
                        Tableau de bord
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile user info -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                    {{ auth()->user()->email }}
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>