<x-app-layout>

    <div class="flex justify-between items-center m-2">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">{{ strtoupper($colocation->nom_coloc) }}</h1>
            <p class="text-gray-400 text-xs mt-0.5">{{ $colocation->created_at->diffForHumans() }}</p>
        </div>

    </div>


    <div class="max-w-7xl mx-auto h-[calc(100vh-140px)] flex gap-6">

        <div class="flex-1 flex gap-6 h-full">

            <div class="flex-1 bg-white -2xl border border-gray-100 flex flex-col h-full">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-800 text-sm">Membres</h2>
                    <span
                        class="px-2 py-1 bg-emerald-100 text-emerald-700 -full text-[11px] font-medium">{{ $colocation->colocationUsers->count() }}
                        actif</span>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-3">
                    @foreach ($colocation->colocationUsers as $membre)
                        <div class="p-3 bg-gray-50  flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ $membre->user->nom }} {{ $membre->user->prenom }}&background=0f4c4c&color=fff&size=40"
                                class="w-10 h-10 -full">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="text-xs font-medium text-gray-800">{{ $membre->user->nom }}
                                        {{ $membre->user->prenom }}</p>
                                    <span
                                        class="px-1.5 py-0.5 {{ $membre->is_owner ? 'bg-[#851313]' : 'bg-[#0f4c4c]' }}  text-white text-[10px] ">{{ $membre->is_owner ? 'owner' : 'membre' }}
                                    </span>
                                </div>
                                <p class="text-[11px] text-gray-400">{{ $membre->user->email }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-800">{{ $membre->user->solde }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="flex-1 bg-white -2xl border border-gray-100 flex flex-col h-full">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-800 text-sm">Dépenses</h2>
                    <button onclick="openModal('expenseModal')"
                        class="w-7 h-7 bg-[#0f4c4c] text-white -lg flex items-center justify-center text-xs">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-3">
                    @if ($colocation->colocationUsers)
                        <div class="p-8 text-center text-gray-400 border-2 border-dashed border-gray-200 ">
                            <i class="fas fa-receipt text-2xl mb-2"></i>
                            <p class="text-xs">Aucune nouvelle dépense</p>
                        </div>
                    @else
                        @foreach ($colocation->colocationUsers as $depense)
                            )
                            <div class="p-3 bg-gray-50 ">
                                <div class="flex justify-between items-start mb-1">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 bg-emerald-100 -lg flex items-center justify-center">
                                            <i class="fas fa-shopping-cart text-emerald-600 text-[10px]"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Courses</p>
                                            <p class="text-[10px] text-gray-400">26 Fév 2026</p>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-800">45.50 €</p>
                                </div>
                                <p class="text-[10px] text-gray-400">Payé par user2</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

        <div class="w-80 flex flex-col gap-6 h-full">

            <div class="bg-white -2xl border border-gray-100 p-5">

                <h3 class="font-semibold text-gray-800 text-sm mb-1">Inviter un membre</h3>
                <p class="text-[11px] text-gray-400 mb-4">Ajoutez quelqu'un à votre colocation</p>
                <button onclick="openModal('inviteModal')"
                    class="w-full py-2.5 bg-[#0f4c4c] text-white  text-xs font-medium">
                    Inviter
                </button>
            </div>
            <div class="bg-white -2xl border border-gray-100 p-5">
                <h3 class="font-semibold text-gray-800 text-sm mb-1">Catégories</h3>
                <p class="text-[11px] text-gray-400 mb-4">Gérez les types de dépenses</p>
                <button onclick="openModal('categoryModal')"
                    class="w-full py-2.5 bg-white text-[#0f4c4c] border border-[#0f4c4c] text-xs font-medium hover:bg-gray-50 transition">
                    Ajouter une catégorie
                </button>
            </div>
            <div class="bg-red-50 -2xl p-5 border border-red-200">

                <h3 class="text-sm font-semibold text-red-900 mb-1">Zone de danger</h3>
                <p class="text-[11px] text-red-700 mb-4">Ces actions sont irréversibles.</p>
                <div class="space-y-2">
                    @if ($colocation->owner_id !== auth()->id())
                        <form action="{{ route('colocations.leave', $colocation->id) }}" method="POST"
                            onsubmit="return confirm('Etes-vous sur de vouloir quitter la colocation ?');">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="w-full py-2 bg-white text-red-600 border border-red-300  text-xs font-medium hover:bg-red-100 transition">
                                Quitter
                            </button>
                        </form>
                    @else
                        <form action="{{ route('colocations.destroy', $colocation->id) }}" method="POST"
                            onsubmit="return confirm('Attention: Cette action est irréversible!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full py-2 bg-red-600 text-white  text-xs font-medium hover:bg-red-700 transition">
                                Annuler la colocation
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

    </div>

    {{-- Modal Inviter --}}
    <div id="inviteModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white -2xl max-w-sm w-full p-5 -2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Inviter un membre</h3>
                <button onclick="closeModal('inviteModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <form action=" {{ route('invitations.store') }}" method="POST" class="space-y-3">
                @csrf
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                <input type="email" name="email"
                    class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200  text-xs focus:outline-none focus:border-[#0f4c4c]"
                    placeholder="Email du membre *">
                <button type="submit"
                    class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold  hover:opacity-90 transition">
                    Envoyer
                </button>
            </form>
        </div>
    </div>
    {{-- Modal Catégorie --}}
    <div id="categoryModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white -2xl max-w-sm w-full p-5 -2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Nouvelle catégorie</h3>
                <button onclick="closeModal('categoryModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-3">
                @csrf
                @method('POST')
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                <div>
                    <label class="text-[10px] text-gray-400 uppercase font-bold mb-1 block">Nom de la catégorie</label>
                    <input type="text" name="nom_categorie" required
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 text-xs focus:outline-none focus:border-[#0f4c4c]"
                        placeholder="Ex: Transport, Factures...">
                </div>
                <button type="submit"
                    class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold hover:opacity-90 transition">
                    Enregistrer la catégorie
                </button>
            </form>
        </div>
    </div>
    {{-- model depense --}}
    <div id="expenseModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white -2xl max-w-md w-full p-5 -2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Nouvelle dépense</h3>
                <button onclick="closeModal('expenseModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <form class="space-y-3">
                <input type="text"
                    class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200  text-xs focus:outline-none focus:border-[#0f4c4c]"
                    placeholder="Titre *" required>
                <div class="grid grid-cols-2 gap-3">
                    <input type="number" step="0.01"
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200  text-xs focus:outline-none focus:border-[#0f4c4c]"
                        placeholder="Montant *" required>
                    <input type="date"
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200  text-xs focus:outline-none focus:border-[#0f4c4c]"
                        required>
                </div>
                <select name="category_id" required
                    class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 text-xs focus:outline-none focus:border-[#0f4c4c]">
                    <option value="" disabled selected >Sélectionner une catégorie</option>
                    @foreach ($colocation->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nom_categorie }}</option>
                    @endforeach 
                </select>
                <button type="submit"
                    class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold  hover:opacity-90 transition">
                    Ajouter
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
