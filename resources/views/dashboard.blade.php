<x-app-layout>
    <div class="flex justify-between items-center m-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800 uppercase tracking-tight">Tableau de bord</h1>
            <p class="text-gray-400 text-xs mt-0.5 italic">Bienvenue, {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto h-[calc(100vh-140px)] flex gap-6 px-4">

        <div class="flex-1 flex gap-6 h-full">

            <div class="flex-1 bg-white -2xl border border-gray-100 flex flex-col h-full shadow-sm">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-800 text-sm italic">
                        <i class="fas fa-history mr-2 text-gray-400"></i>Activité par Colocation
                    </h2>
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 -full text-[11px] font-medium">
                        {{ $user->colocationUsers->count() }} Coloc(s)
                    </span>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-6 custom-scrollbar">
                    @forelse ($user->colocationUsers as $member)
                        <div class="bg-white -xl border border-gray-100 overflow-hidden shadow-sm">
                            <div class="bg-gray-50/50 px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                                <span class="font-bold text-xs text-gray-700 uppercase tracking-wider">{{ $member->colocation->nom_coloc }}</span>
                                <span class="text-[9px] {{ $member->is_owner ? 'border text-green-600  bg-green-50' :   ' bg-blue-50 text-blue-600' }}  px-2 py-0.5 -lg uppercase font-bold">
                                    {{ $member->is_owner ? 'Owner' : 'Membre' }}
                                </span>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-gray-50/30 text-gray-400 text-[10px] uppercase">
                                        <tr>
                                            <th class="px-4 py-2 font-medium">Description</th>
                                            <th class="px-4 py-2 font-medium">Catégorie</th>
                                            <th class="px-4 py-2 text-right font-medium">Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach ($member->depenses->take(5) as $depense)
                                            <tr class="hover:bg-gray-50/80 transition-colors">
                                                <td class="px-4 py-3">
                                                    <p class="text-xs font-semibold text-gray-800">{{ $depense->titre }}</p>
                                                    <p class="text-[9px] text-gray-400">{{ $depense->created_at->diffForHumans() }}</p>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <span class="px-2 py-0.5  bg-gray-100 text-gray-600 text-[9px]">
                                                        {{ $depense->categorie->nom_categorie ?? 'Général' }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-right text-xs font-bold text-gray-700">
                                                    {{ number_format($depense->montant, 2) }} MAD
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center text-gray-400 border-2 border-dashed border-gray-100 -2xl">
                            <i class="fas fa-receipt text-2xl mb-2 opacity-20"></i>
                            <p class="text-xs italic">Vous n'êtes membre d'aucune colocation pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="w-80 flex flex-col gap-4 h-full">
            
            <div class="bg-white -2xl p-5 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-amber-100 -xl flex items-center justify-center">
                        <i class="fas fa-star text-amber-600 text-xs"></i>
                    </div>
                    <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Réputation</span>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ $user->reputation }}</p>
                <p class="text-xs text-gray-400 mt-1 italic">Score de confiance</p>
            </div>

            <div class="bg-white -2xl p-5 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-100 -xl flex items-center justify-center">
                        <i class="fas fa-receipt text-blue-600 text-xs"></i>
                    </div>
                    <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Ce mois</span>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($total_depenses, 2) }} MAD</p>
                <p class="text-xs text-gray-400 mt-1 italic">Dépenses totales</p>
            </div>

            <div class="bg-white -2xl p-5 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 {{ $user->solde >= 0 ? 'bg-green-100' : 'bg-red-100' }} -xl flex items-center justify-center">
                        <i class="fas fa-wallet {{ $user->solde >= 0 ? 'text-green-600' : 'text-red-600' }} text-xs"></i>
                    </div>
                    <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Mon Solde</span>
                </div>
                <p class="text-2xl font-bold {{ $user->solde >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ number_format($user->solde, 2) }} MAD
                </p>
                <p class="text-xs text-gray-400 mt-1 italic">État financier global</p>
            </div>
        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
</x-app-layout>