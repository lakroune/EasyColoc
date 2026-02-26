<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">coloc 3</h1>
                <p class="text-gray-400 text-xs mt-0.5">Créée le 26 février 2026</p>
            </div>
            <div class="flex gap-2">
                <button onclick="openModal('inviteModal')" class="px-4 py-2 bg-[#0f4c4c] text-white rounded-xl text-xs font-medium">
                    <i class="fas fa-user-plus mr-2"></i>Inviter
                </button>
                <button class="px-3 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        
        {{-- Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-4 border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-400">Adresse</p>
                        <p class="text-xs font-medium text-gray-800">Paris, France</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-euro-sign text-emerald-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-400">Loyer total</p>
                        <p class="text-xs font-medium text-gray-800">0.00 €/mois</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar text-purple-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-400">Prochaine échéance</p>
                        <p class="text-xs font-medium text-gray-800">-</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Members --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Membres</h2>
                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[11px] font-medium">1 actif</span>
            </div>
            
            <div class="divide-y divide-gray-100">
                {{-- Owner --}}
                <div class="p-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=User+2&background=0f4c4c&color=fff&size=40" class="w-10 h-10 rounded-full">
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-xs font-medium text-gray-800">user2</p>
                                <span class="px-1.5 py-0.5 bg-[#0f4c4c] text-white text-[11px] rounded">Owner</span>
                            </div>
                            <p class="text-[11px] text-gray-400">user2@example.com</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-800">0.00 €</p>
                        <p class="text-[11px] text-gray-400">Solde</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dépenses récentes --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Dernières dépenses</h2>
                <a href="#" class="text-[11px] text-[#0f4c4c] hover:underline">Voir tout</a>
            </div>
            
            <div class="p-8 text-center text-gray-400">
                <i class="fas fa-receipt text-3xl mb-2"></i>
                <p class="text-xs">Aucune dépense pour le moment</p>
                <button onclick="openModal('expenseModal')" class="mt-3 px-4 py-2 bg-[#0f4c4c] text-white rounded-xl text-xs">
                    Ajouter une dépense
                </button>
            </div>
        </div>

        {{-- Danger Zone --}}
        <div class="bg-red-50 rounded-2xl p-5 border border-red-200">
            <h3 class="text-sm font-semibold text-red-900 mb-1">Zone de danger</h3>
            <p class="text-[11px] text-red-700 mb-3">Ces actions sont irréversibles.</p>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-white text-red-600 border border-red-300 rounded-xl text-xs">
                    Quitter
                </button>
                <button class="px-4 py-2 bg-red-600 text-white rounded-xl text-xs">
                    Annuler la colocation
                </button>
            </div>
        </div>

    </div>

    {{-- Modal Inviter --}}
    <div id="inviteModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl max-w-sm w-full p-5 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Inviter un membre</h3>
                <button onclick="closeModal('inviteModal')" class="text-gray-400">✕</button>
            </div>
            <form class="space-y-3">
                <input type="email" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs" placeholder="Email du membre *">
                <div class="p-3 bg-blue-50 rounded-xl text-[11px] text-blue-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Une invitation sera envoyée par email avec un lien unique valable 7 jours.
                </div>
                <button type="submit" class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold rounded-xl">
                    Envoyer
                </button>
            </form>
        </div>
    </div>

    <div id="expenseModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl max-w-md w-full p-5 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Nouvelle dépense</h3>
                <button onclick="closeModal('expenseModal')" class="text-gray-400">✕</button>
            </div>
            <form class="space-y-3">
                <input type="text" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs" placeholder="Titre *">
                <div class="grid grid-cols-2 gap-3">
                    <input type="number" step="0.01" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs" placeholder="Montant *">
                    <input type="date" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                </div>
                <select class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                    <option>Catégorie</option>
                    <option>Alimentation</option>
                    <option>Logement</option>
                    <option>Loisirs</option>
                </select>
                <button type="submit" class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold rounded-xl">
                    Ajouter
                </button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
    </script>
</x-app-layout>