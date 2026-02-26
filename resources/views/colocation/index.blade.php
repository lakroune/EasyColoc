<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">MES COLOCATIONS</h1>
            <button onclick="openModal('createModal')"
                class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-medium flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Nouvelle colocation
            </button>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($colocations as $coloc)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 hover:shadow-lg transition cursor-pointer">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                            {{ $coloc->nom_coloc[0] }}
                        </div>
                        <div class="flex gap-2">
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-medium">
                                <i class="fas fa-crown mr-1"></i>{{ 'Membre' }}
                            </span>
                            <span
                                class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-medium">{{ 'Inactif' }}</span>
                        </div>
                    </div>

                    <h3 class="font-semibold text-gray-800 mb-1">{{ $coloc->nom_coloc }}</h3>
                    <p class="text-[11px] text-gray-400 mb-4">{{ $coloc->colocationUsers->count() }} membres</p>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase">Dépenses</p>
                            {{-- <p class="text-sm font-medium text-gray-800">{{ $coloc ->colocationUsers->depense->count() }}</p> --}}
                        </div>
                        <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                            <a href="{{ route('colocations.show', $coloc->id) }}"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="bg-gray-50 rounded-2xl border border-gray-200 p-5 opacity-60">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                        C
                    </div>
                    <div class="flex gap-2">
                        <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-medium">
                            <i class="fas fa-crown mr-1"></i>OWNER
                        </span>
                        <span
                            class="px-2 py-1 bg-gray-200 text-gray-600 rounded-full text-[10px] font-medium">CANCELLED</span>
                    </div>
                </div>

                <h3 class="font-semibold text-gray-800 mb-1">coloc 2</h3>
                <p class="text-[11px] text-gray-400 mb-4">2 MEMBRES</p>

                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase">Dépenses</p>
                        <p class="text-sm font-medium text-gray-800">1</p>
                    </div>
                    <div class="w-8 h-8 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                        <i class="fas fa-arrow-right text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl border border-gray-200 p-5 opacity-60">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="w-12 h-12 bg-gray-400 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                        C
                    </div>
                    <div class="flex gap-2">
                        <span class="px-2 py-1 bg-gray-300 text-gray-600 rounded-full text-[10px] font-medium">
                            <i class="fas fa-door-open mr-1"></i>QUITTÉE
                        </span>
                        <span
                            class="px-2 py-1 bg-gray-200 text-gray-600 rounded-full text-[10px] font-medium">CANCELLED</span>
                    </div>
                </div>

                <h3 class="font-semibold text-gray-800 mb-1">coloc 1</h3>
                <p class="text-[11px] text-gray-400 mb-4">1 MEMBRES</p>

                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase">Dépenses</p>
                        <p class="text-sm font-medium text-gray-800">2</p>
                    </div>
                    <div class="w-8 h-8 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                        <i class="fas fa-arrow-right text-xs"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="fixed bottom-6 left-6 bg-slate-900 rounded-xl p-4 text-white w-48">
            <p class="text-[10px] text-gray-400 uppercase mb-1">Votre réputation</p>
            <p class="text-lg font-semibold mb-2">+0 points</p>
            <div class="w-full bg-gray-700 rounded-full h-1.5">
                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 0%"></div>
            </div>
        </div>

    </div>

    <div id="createModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800">Nouvelle colocation</h3>
                <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <form action=" {{ route('colocations.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Nom de la colocation</label>
                    <input type="text" name="nom_coloc"
                        class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500"
                        placeholder="Ex: Appartement Paris">
                </div>

                <button type="submit"
                    class="w-full py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition">
                    Créer
                </button>
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
