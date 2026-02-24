<nav x-data="{ open: false }" class="bg-white border-b border-teal-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-teal-700 rounded-lg flex items-center justify-center">
                            <i class="fas fa-home text-white text-[10px]"></i>
                        </div>
                        <span class="font-bold text-teal-900 tracking-tight">EasyColoc</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-teal-900 border-teal-600">
                        {{ __('Tableau de bord') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-teal-800 bg-teal-50 hover:bg-teal-100 transition ease-in-out duration-150">
                            <div class="mr-2">{{ Auth::user()->name }}</div>
                            <i class="fas fa-chevron-down text-xs text-teal-600"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-teal-800 hover:bg-teal-50">
                            {{ __('Mon Profil') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" 
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 hover:bg-red-50">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="text-teal-700 p-2">
                    <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
        </div>
    </div>
</nav>