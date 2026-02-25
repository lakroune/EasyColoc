<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Appartement Paris Centre</h1>
                <p class="text-gray-400 text-xs mt-0.5">Créée le 15 janvier 2024</p>
            </div>
            <button onclick="openModal('inviteModal')"
                class="px-4 py-2 bg-[#0f4c4c] text-white rounded-xl text-xs font-medium">
                <i class="fas fa-user-plus mr-2"></i>Inviter
            </button>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">



        <div class="bg-white rounded-2xl border border-gray-100">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Membres</h2>
                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[11px] font-medium">4
                    actifs</span>
            </div>

            <div class="divide-y divide-gray-100">
                <div class="p-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Jean+Dupont&background=0f4c4c&color=fff&size=40"
                            class="w-10 h-10 rounded-full">
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-xs font-medium text-gray-800">Jean Dupont</p>
                                <span class="px-1.5 py-0.5 bg-[#0f4c4c] text-white text-[11px] rounded">Owner</span>
                            </div>
                            <p class="text-[11px] text-gray-400">jean.dupont@email.com</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-emerald-600">+45.50 €</p>
                    </div>
                </div>

                {{-- Member 2 --}}
                <div class="p-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Marie+Martin&background=10b981&color=fff&size=40"
                            class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-xs font-medium text-gray-800">Marie Martin</p>
                            <p class="text-[11px] text-gray-400">marie.martin@email.com</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-red-500">-25.00 €</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Danger Zone --}}
        <div class="bg-red-50 rounded-2xl p-5 border border-red-200">
            <h3 class="text-sm font-semibold text-red-900 mb-1">Zone de danger</h3>
            <p class="text-[11px] text-red-700 mb-3">Ces actions sont irréversibles.</p>
            <div class="flex gap-2">
                <button
                    class="px-4 py-2 bg-white text-red-600 border border-red-300 rounded-xl text-xs">Quitter</button>
                <button class="px-4 py-2 bg-red-600 text-white rounded-xl text-xs">Annuler la colocation</button>
            </div>
        </div>

    </div>

    {{-- Modal --}}
    <div id="inviteModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl max-w-sm w-full p-5 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Inviter un membre</h3>
                <button onclick="closeModal('inviteModal')" class="text-gray-400">✕</button>
            </div>
            <form>
                <input type="email"
                    class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs mb-3"
                    placeholder="Email du membre *">
                <button type="button"
                    class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold rounded-xl">Envoyer</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-app-layout>
