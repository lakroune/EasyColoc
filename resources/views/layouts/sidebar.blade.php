<aside id="sidebar" class="sidebar fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 shadow-xl lg:shadow-none overflow-y-auto flex flex-col">
    
    <div class="p-6 border-b border-gray-50 flex items-center gap-3">
        <div class="w-9 h-9 bg-gradient-to-br from-teal-700 to-teal-900 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fas fa-home text-white text-sm"></i>
        </div>
        <span class="font-bold text-teal-950 tracking-tight text-lg">EasyColoc</span>
    </div>

    <nav class="p-4 space-y-1 flex-1">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-chart-pie w-5"></i> {{ __('Tableau de bord') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('colocations.index')" :active="request()->routeIs('colocation.*')">
            <i class="fas fa-house-user w-5"></i> {{ __('Ma Colocation') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')">
            <i class="fas fa-receipt w-5"></i> {{ __('Dépenses') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('balances.index')" :active="request()->routeIs('balances.*')">
            <i class="fas fa-scale-balanced w-5"></i> {{ __('Balances') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('settlements.index')" :active="request()->routeIs('settlements.*')">
            <i class="fas fa-hand-holding-dollar w-5"></i> {{ __('Remboursements') }}
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
            <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-red-600 hover:bg-red-50 rounded-xl transition text-xs font-medium">
                <i class="fas fa-sign-out-alt w-5"></i> {{ __('Déconnexion') }}
            </button>
        </form>
    </div>
</aside>