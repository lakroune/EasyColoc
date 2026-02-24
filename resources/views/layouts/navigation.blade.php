<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-teal-100/50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-teal-800 to-teal-950 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-home text-white text-[11px]"></i>
                </div>
                <span class="font-bold text-teal-950 tracking-tight text-sm">EasyColoc</span>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-10 gap-6">
                <a href="{{ route('dashboard') }}" class="text-xs font-medium text-teal-900 hover:text-teal-600 transition">
                    {{ __('Tableau de bord') }}
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-teal-100 text-xs font-medium rounded-full text-teal-900 bg-white hover:bg-teal-50 transition shadow-sm">
                            <i class="fas fa-user-circle mr-2 text-teal-600"></i>
                            {{ Auth::user()->name }}
                            <i class="fas fa-chevron-down ml-2 text-[10px] text-teal-400"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-teal-900">
                            {{ __('Mon Profil') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" 
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="text-teal-700 p-2 hover:bg-teal-50 rounded-lg">
                    <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
        </div>
    </div>
</nav>