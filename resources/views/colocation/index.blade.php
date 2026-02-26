<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">MES COLOCATIONS</h1>
            <button onclick="openModal('createModal')"
                class="px-4 py-2 bg-indigo-600 text-white -xl text-xs font-medium flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Nouvelle colocation
            </button>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($colocations as $coloc)
                <div
                    class=" border border-gray-200 p-5 transition {{ !$coloc->status || $coloc->colocationUsers->where('user_id', auth()->id())->first()->is_leave  ? 'opacity-60 bg-gray-50 cursor-not-allowed' : 'bg-white   cursor-pointer' }}">

                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-12 h-12 {{ $coloc->status ? 'bg-indigo-600' : 'bg-gray-400' }}  flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($coloc->nom_coloc, 0, 1)) }}
                        </div>

                        <div class="flex gap-2">
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 text-[10px] font-medium ">

                                {{ $coloc->owner_id == auth()->id() ? 'OWNER' : 'MEMBRE' }}
                            </span>

                            <span
                                class="px-2 py-1 {{ $coloc->status ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-600' }} text-[10px] font-medium ">
                                {{ $coloc->status ? 'ACTIF' : 'INACTIF' }}
                            </span>
                        </div>
                    </div>

                    <h3 class="font-semibold text-gray-800 mb-1">{{ $coloc->nom_coloc }}</h3>
                    <p class="text-[11px] text-gray-400 mb-4 uppercase">{{ $coloc->colocationUsers->count() }} Membres
                    </p>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase">Dépenses</p>
                            <p class="text-sm font-medium text-gray-800">{{ $coloc->depenses_count ?? 0 }}</p>
                        </div>

                        <div
                            class="w-8 h-8 {{ $coloc->status ? 'bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white' : 'bg-gray-100 text-gray-400' }} rounded-lg flex items-center justify-center transition">
                            @if ($coloc->status && !$coloc->colocationUsers->where('user_id', auth()->id())->first()->is_leave)
                                <a href="{{ route('colocations.show', $coloc->id) }}">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            @else
                                <i class="fas fa-lock text-xs"></i>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="fixed bottom-6 left-6 bg-slate-900 -xl p-4 text-white w-48">
            <p class="text-[10px] text-gray-400 uppercase mb-1">Votre réputation</p>
            <p class="text-lg font-semibold mb-2">+0 points</p>
            <div class="w-full bg-gray-700  h-1.5">
                <div class="bg-emerald-500 h-1.5 " style="width: 0%"></div>
            </div>
        </div>

    </div>

    <div id="createModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white -2xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800">Nouvelle colocation</h3>
                <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <form action=" {{ route('colocations.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Nom de la colocation</label>
                    <input type="text" name="nom_coloc"
                        class="w-full px-3 py-2 border border-gray-200 -xl text-sm focus:outline-none focus:border-indigo-500"
                        placeholder="Ex: Appartement Paris">
                </div>

                <button type="submit"
                    class="w-full py-2.5 bg-indigo-600 text-white -xl text-sm font-medium hover:bg-indigo-700 transition">
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
