<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Dépenses</h1>
                <p class="text-gray-400 text-xs mt-0.5">Historique et gestion</p>
            </div>
            <button onclick="openModal('addExpenseModal')" class="px-4 py-2 bg-[#0f4c4c] text-white rounded-xl text-xs font-medium">
                <i class="fas fa-plus mr-2"></i>Nouvelle dépense
            </button>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-4">
        
        {{-- Filters --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-4">
            <div class="flex flex-wrap gap-3">
                <select class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                    <option>Tous les mois</option>
                    <option>Février 2024</option>
                    <option>Janvier 2024</option>
                </select>
                <select class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                    <option>Toutes catégories</option>
                    <option>Alimentation</option>
                    <option>Logement</option>
                </select>
                <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs">Filtrer</button>
            </div>
        </div>

        {{-- Summary --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="bg-white rounded-xl p-3 border border-gray-100">
                <p class="text-[11px] text-gray-400">Total période</p>
                <p class="text-base font-semibold text-gray-800">845.50 €</p>
            </div>
            <div class="bg-white rounded-xl p-3 border border-gray-100">
                <p class="text-[11px] text-gray-400">Ma part</p>
                <p class="text-base font-semibold text-teal-600">211.38 €</p>
            </div>
            <div class="bg-white rounded-xl p-3 border border-gray-100">
                <p class="text-[11px] text-gray-400">J'ai payé</p>
                <p class="text-base font-semibold text-emerald-600">320.00 €</p>
            </div>
            <div class="bg-white rounded-xl p-3 border border-gray-100">
                <p class="text-[11px] text-gray-400">Transactions</p>
                <p class="text-base font-semibold text-gray-800">12</p>
            </div>
        </div>

        {{-- Expenses Table --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-[11px] font-medium text-gray-400">Date</th>
                        <th class="px-4 py-3 text-left text-[11px] font-medium text-gray-400">Dépense</th>
                        <th class="px-4 py-3 text-left text-[11px] font-medium text-gray-400 hidden sm:table-cell">Catégorie</th>
                        <th class="px-4 py-3 text-right text-[11px] font-medium text-gray-400">Montant</th>
                        <th class="px-4 py-3 text-center text-[11px] font-medium text-gray-400"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-[11px] text-gray-500">24 Fév</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-emerald-600 text-[11px]"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-800">Courses</p>
                                    <p class="text-[11px] text-gray-400">Carrefour</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 hidden sm:table-cell">
                            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-[11px]">Alimentation</span>
                        </td>
                        <td class="px-4 py-3 text-right text-xs font-medium text-gray-800">65.40 €</td>
                        <td class="px-4 py-3 text-center">
                            <button class="text-gray-400 hover:text-red-500"><i class="fas fa-trash text-xs"></i></button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-[11px] text-gray-500">23 Fév</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-bolt text-blue-600 text-[11px]"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-800">Electricité</p>
                                    <p class="text-[11px] text-gray-400">EDF Février</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 hidden sm:table-cell">
                            <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-[11px]">Logement</span>
                        </td>
                        <td class="px-4 py-3 text-right text-xs font-medium text-gray-800">120.00 €</td>
                        <td class="px-4 py-3 text-center">
                            <button class="text-gray-400 hover:text-red-500"><i class="fas fa-trash text-xs"></i></button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-[11px] text-gray-500">20 Fév</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-utensils text-amber-600 text-[11px]"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-800">Dîner</p>
                                    <p class="text-[11px] text-gray-400">Pizza Party</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 hidden sm:table-cell">
                            <span class="px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full text-[11px]">Loisirs</span>
                        </td>
                        <td class="px-4 py-3 text-right text-xs font-medium text-gray-800">48.00 €</td>
                        <td class="px-4 py-3 text-center">
                            <button class="text-gray-400 hover:text-red-500"><i class="fas fa-trash text-xs"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    <div id="addExpenseModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl max-w-md w-full p-5 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Nouvelle dépense</h3>
                <button onclick="closeModal('addExpenseModal')" class="text-gray-400">✕</button>
            </div>
            <form class="space-y-3">
                <input type="text" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs" placeholder="Titre *" required>
                <div class="grid grid-cols-2 gap-3">
                    <input type="number" step="0.01" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs" placeholder="Montant *" required>
                    <input type="date" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs" required>
                </div>
                <select class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                    <option>Catégorie *</option>
                    <option>Alimentation</option>
                    <option>Logement</option>
                    <option>Loisirs</option>
                </select>
                <select class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                    <option>Payeur *</option>
                    <option>Moi</option>
                    <option>Marie</option>
                    <option>Paul</option>
                </select>
                <button type="submit" class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold rounded-xl">Ajouter</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
    </script>
</x-app-layout>