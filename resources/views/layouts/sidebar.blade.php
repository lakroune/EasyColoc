<aside id="sidebar" class="sidebar fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100  lg:shadow-none overflow-y-auto flex flex-col">
    
    <div class="p-6 border-b border-gray-50 flex items-center gap-3">
         <div class="flex   gap-2">
            <img src="{{ asset('logo/logo.png') }}" alt="Logo EsyColoc" class="w-[80%] ">
        </div>
    </div>
    <nav class="p-4 space-y-1 flex-1">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-chart-pie w-5"></i> {{ __('Tableau de bord') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('colocations.index')" :active="request()->routeIs('colocation.*')">
            <i class="fas fa-house-user w-5"></i> {{ __('Ma Colocation') }}
        </x-sidebar-link>


        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
            <i class="fas fa-user-circle w-5"></i> {{ __('Mon Profil') }}
        </x-sidebar-link>

        @if(Auth::user()->isAdmin())
            <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                Administration
            </div>
            <x-sidebar-link :href="route('admin.stats')" :active="request()->routeIs('admin.stats')">
                <i class="fas fa-chart-line w-5"></i> {{ __('Statistiques') }}
            </x-sidebar-link>
            <x-sidebar-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                <i class="fas fa-users w-5"></i> {{ __('Utilisateurs') }}
            </x-sidebar-link>
        @endif
    </nav>

    <div class="p-4 border-t border-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-red-600 hover:bg-red-50 transition text-xs font-medium">
                <i class="fas fa-sign-out-alt w-5"></i> {{ __('Déconnexion') }}
            </button>
        </form>
    </div>
</aside>