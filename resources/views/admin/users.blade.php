<x-app-layout>
    <div class="h-[calc(100vh-80px)] p-6">
        <div class="max-w-7xl mx-auto h-full flex flex-col">
            <div class="flex-1 bg-white border border-gray-100 rounded-xl overflow-hidden flex flex-col">
                <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="font-semibold text-gray-800 text-xs uppercase tracking-wider">Liste des utilisateurs</h2>
                </div>

                <div class="flex-1 overflow-y-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr class="text-gray-400 text-[10px] uppercase tracking-wider">
                                <th class="px-4 py-3 font-medium">Utilisateur</th>
                                <th class="px-4 py-3 font-medium">Email</th>
                                <th class="px-4 py-3 font-medium">Réputation</th>
                                <th class="px-4 py-3 font-medium">Colocations</th>
                                <th class="px-4 py-3 font-medium">État</th>
                                <th class="px-4 py-3 font-medium text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($users as $user)
                                <tr
                                    class="hover:bg-gray-50/50 transition {{ !$user->is_banned ? '' : 'opacity-50 bg-gray-50' }}">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nom . ' ' . $user->prenom) }}&background={{ $user->is_banned ? '9ca3af' : '0f4c4c' }}&color=fff&size=36"
                                                class="w-9 h-9 rounded-full">
                                            <div>
                                                <p class="text-xs font-medium text-gray-800">{{ $user->nom }}
                                                    {{ $user->prenom }}</p>
                                                <p class="text-[10px] text-gray-400">#{{ $user->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-600">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-1">
                                            @if ($user->reputation > 0)
                                                <i class="fas fa-arrow-up text-emerald-500 text-[10px]"></i>
                                            @elseif($user->reputation < 0)
                                                <i class="fas fa-arrow-down text-red-500 text-[10px]"></i>
                                            @else
                                                <i class="fas fa-minus text-gray-400 text-[10px]"></i>
                                            @endif
                                            <span
                                                class="px-2 py-0.5 {{ $user->reputation >= 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} rounded text-[10px] font-medium">
                                                {{ abs($user->reputation) }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-600">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-[10px]">
                                            <i class="fas fa-home text-[9px]"></i>
                                            {{ $user->colocation_users_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($user->is_banned === false)
                                            <span
                                                class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-medium">
                                                Actif
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-[10px] font-medium">
                                                Banni
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('admin.users.toggle-status', $user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ $user->is_banned ? 'Débannir' : 'Bannir' }} cet utilisateur ?');">
                                            @csrf
                                            @method('PATCH')
                                            @if ($user->is_banned === false)
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 rounded-lg hover:bg-red-100 transition text-[10px] font-medium">
                                                    <i class="fas fa-user-slash text-[10px]"></i>
                                                    Bannir
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-lg hover:bg-emerald-100 transition text-[10px] font-medium">
                                                    <i class="fas fa-user-check text-[10px]"></i>
                                                    Débannir
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100 bg-gray-50/30">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
