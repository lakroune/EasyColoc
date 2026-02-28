<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Liste des utilisateurs</h2>
                    <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 text-sm font-bold rounded-full">
                        Total: {{ $users->total() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-xs uppercase tracking-wider border-b">
                                <th class="pb-4 font-semibold">Utilisateur</th>
                                <th class="pb-4 font-semibold">Email</th>
                                <th class="pb-4 font-semibold">Réputation</th>
                                <th class="pb-4 font-semibold">Colocations</th>
                                <th class="pb-4 font-semibold">État</th>
                                <th class="pb-4 font-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition {{ !$user->is_active ? 'opacity-60 bg-gray-100' : '' }}">
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ $user->nom }}&background=random"
                                                class="w-10 h-10 rounded-full">
                                            <div>
                                                <div class="text-sm font-medium text-gray-700">{{ $user->nom }} {{ $user->prenom }}</div>
                                                <div class="text-xs text-gray-400">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 {{ $user->reputation >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }} rounded text-xs font-bold">
                                            {{ $user->reputation }} pts
                                        </span>
                                    </td>
                                    <td class="py-4 text-sm text-gray-600">
                                        <i class="fas fa-home mr-1 opacity-50"></i> {{ $user->colocation_users_count }}
                                    </td>
                                    <td class="py-4">
                                        @if($user->is_active)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Actif</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Banni</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-center">
                                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le statut de cet utilisateur ?');">
                                            @csrf
                                            @method('PATCH')
                                            @if($user->is_active)
                                                <button type="submit" class="flex items-center gap-1 mx-auto px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-xs font-semibold">
                                                    <i class="fas fa-user-slash"></i> Banner
                                                </button>
                                            @else
                                                <button type="submit" class="flex items-center gap-1 mx-auto px-3 py-1.5 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition text-xs font-semibold">
                                                    <i class="fas fa-user-check"></i> Débanner
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>