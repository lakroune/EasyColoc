<aside id="sidebar" class="sidebar fixed lg:static inset-y-0 left-0 z-50 w-60 bg-white/80 backdrop-blur-xl border-r border-teal-100/50 shadow-2xl lg:shadow-none overflow-y-auto">
    <div class="p-6 border-b border-teal-100/50 flex items-center gap-3">
        <div class="w-9 h-9 bg-gradient-to-br from-teal-800 to-teal-950 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fas fa-home text-white text-sm"></i>
        </div>
        <span class="font-bold text-teal-950 text-sm tracking-tight">EasyColoc</span>
    </div>

    <nav class="p-4 space-y-1">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-chart-pie w-5"></i>
            {{ __('Tableau de bord') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('colocations.index')" :active="request()->routeIs('colocation.*')">
            <i class="fas fa-house-user w-5"></i>
            {{ __('Ma Colocation') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')">
            <i class="fas fa-receipt w-5"></i>
            {{ __('Dépenses') }}
        </x-sidebar-link>
    </nav>

    <div class="p-4 border-t border-teal-100/50 mt-auto">
        <a href="{{ route('profile.edit') }}" 
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile.*') ? 'bg-gradient-to-r from-teal-800 to-teal-950 text-white shadow-md' : 'text-teal-900 hover:bg-teal-50' }} rounded-xl transition text-xs font-medium">
            <i class="fas fa-user w-5"></i>
            <span>{{ __('Mon Profil') }}</span>
        </a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition text-xs">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span>{{ __('Déconnexion') }}</span>
            </button>
        </form>
    </div>
</aside>