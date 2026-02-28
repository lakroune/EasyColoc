<x-app-layout>

    <div class="flex justify-between items-center m-2">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">{{ strtoupper($colocation->nom_coloc) }}</h1>
            <p class="text-gray-400 text-xs mt-0.5">{{ $colocation->created_at->diffForHumans() }}</p>
        </div>

    </div>

    <div class="max-w-[98%] mx-auto h-[calc(100vh-140px)] flex gap-6">

        <div class="flex-1 bg-white border border-gray-100 flex flex-col h-full">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Membres</h2>

                <button onclick="openModal('adminModal')"
                    class="w-7 h-7 bg-white text-gray-500 border border-gray-200 flex items-center justify-center text-xs hover:border-gray-300">
                    <i class="fas fa-cog"></i>
                </button>



            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                @foreach ($membres as $membre)
                    <div class="p-3 bg-gray-50 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ $membre->user->nom }} {{ $membre->user->prenom }}&background=0f4c4c&color=fff&size=40"
                            class="w-10 h-10">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <p class="text-xs font-medium text-gray-800">{{ $membre->user->nom }}
                                    {{ $membre->user->prenom }}</p>
                                <span
                                    class="px-1.5 py-0.5 {{ $membre->is_owner ? 'bg-[#851313]' : 'bg-[#0f4c4c]' }} text-white text-[10px]">
                                    {{ $membre->is_owner ? 'owner' : 'membre' }}
                                </span>
                            </div>
                            <p class="text-[11px] text-gray-400">{{ $membre->user->email }}</p>
                        </div>
                        <div class="text-right">
                            <p
                                class="text-sm font-semibold {{ $membre->user->reputation >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $membre->user->reputation }}
                            </p>
                            <i class="fas fa-{{ $membre->user->reputation >= 0 ? '' : '' }} text-[10px] "></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex-1 bg-white border border-gray-100 flex flex-col h-full">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Dépenses</h2>
                <button onclick="openModal('expenseModal')"
                    class="w-7 h-7 bg-[#0f4c4c] text-white flex items-center justify-center text-xs">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                @if ($depenses->isEmpty())
                    <div class="p-8 text-center text-gray-400 border-2 border-dashed border-gray-200">
                        <i class="fas fa-receipt text-2xl mb-2"></i>
                        <p class="text-xs">Aucune nouvelle dépense</p>
                    </div>
                @else
                    @foreach ($depenses as $depense)
                        <div class="p-3 bg-gray-50">
                            <div class="flex justify-between items-start mb-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-emerald-100 flex items-center justify-center">
                                        <i class="fas fa-shopping-cart text-emerald-600 text-[10px]"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-800">
                                            {{ $depense->categorie->nom_categorie ?? 'Général' }}</p>
                                        <p class="text-[10px] text-gray-400">{{ $depense->titre }}</p>
                                    </div>
                                </div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ number_format($depense->montant, 2) }} MAD</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-[10px] text-gray-400">Payé par
                                    {{ $depense->colocationUser->user->nom }}
                                    {{ $depense->colocationUser->user->prenom }}</p>
                                <p class="text-[10px] text-gray-400">{{ $depense->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="flex-1 bg-white border border-gray-100 flex flex-col h-full">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Qui doit à qui</h2>

            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                @forelse ($dettes as $dette)
                    <div
                        class="p-3 {{ $dette->statut ? 'bg-emerald-50 border border-emerald-100' : ' bg-red-50 border border-red-100' }} flex justify-between items-center">
                        <div>
                            <p class="text-[10px] font-bold text-gray-900">
                                {{ $dette->colocationUser->user->nom }}

                                <span class="font-normal text-black-600">doit</span>

                                {{ $dette->depense->colocationUser->user->nom }}
                            </p>

                            <p
                                class="text-[10px] font-semibold {{ $dette->statut ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ number_format($dette->montant, 2) }} MAD
                            </p>
                        </div>

                        @if ($dette->statut == false and $dette->colocationUser->user_id === auth()->user()->id)
                            <form action="{{ route('dettes.update', $dette->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="text-[10px] bg-emerald-600 text-white px-3 py-1.5 font-semibold hover:bg-emerald-700 transition">
                                    Marquer
                                </button>
                            </form>
                        @elseif($dette->statut == true)
                            <span class="text-[10px] font-semibold ">
                                <i class="fas fa-check text-emerald-600"></i>
                            </span>
                        @endif
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400 border-2 border-dashed border-gray-200">
                        <i class="fas fa-receipt text-2xl mb-2"></i>
                        <p class="text-xs">Aucune nouvelle dette</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- Modal Inviter --}}
    <div id="inviteModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white max-w-sm w-full p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Inviter un membre</h3>
                <button onclick="closeModal('inviteModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <form action="{{ route('invitations.store') }}" method="POST" class="space-y-3">
                @csrf
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                <input type="email" name="email"
                    class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 text-xs focus:outline-none focus:border-[#0f4c4c]"
                    placeholder="Email du membre *">
                <button type="submit"
                    class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold hover:opacity-90 transition">
                    Envoyer
                </button>
            </form>
        </div>
    </div>

    {{-- Modal Administration (Quitter/Annuler/Catégorie) --}}
    <div id="adminModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white max-w-sm w-full p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Options</h3>
                <button onclick="closeModal('adminModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>

            <div class="space-y-3">
                @if ($colocation->owner_id == auth()->user()->id)
                    <button onclick="openModal('inviteModal'); closeModal('adminModal');"
                        class="w-full py-2.5 bg-[#0f4c4c] text-white border border-[#0f4c4c] text-xs font-medium hover:bg-[#0f4c4c]/90 transition">
                        <i class="fas fa-user-plus mr-1"></i> Inviter un membre
                    </button>
                    <button onclick="openModal('categoryModal'); closeModal('adminModal');"
                        class="w-full py-2.5 bg-white text-[#0f4c4c] border border-[#0f4c4c] text-xs font-medium hover:bg-gray-50 transition">
                        <i class="fas fa-tags mr-1"></i> Gérer catégories
                    </button>
                @endif

                @if ($colocation->owner_id !== auth()->id())
                    <form action="{{ route('colocations.leave', $colocation->id) }}" method="POST"
                        onsubmit="return confirm('Etes-vous sur de vouloir quitter la colocation ?');">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-full py-2.5 bg-white text-red-600 border border-red-300 text-xs font-medium hover:bg-red-100 transition">
                            <i class="fas fa-sign-out-alt mr-1"></i> Quitter
                        </button>
                    </form>
                @else
                    <form action="{{ route('colocations.destroy', $colocation->id) }}" method="POST"
                        onsubmit="return confirm('Attention: Cette action est irréversible!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full py-2.5 bg-red-600 text-white text-xs font-medium hover:bg-red-700 transition">
                            <i class="fas fa-trash-alt mr-1"></i> Annuler
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal Catégorie --}}
    <div id="categoryModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white max-w-sm w-full p-5">
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

    {{-- Modal Dépense --}}
    <div id="expenseModal"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white max-w-md w-full p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 text-sm">Nouvelle dépense</h3>
                <button onclick="closeModal('expenseModal')" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <form class="space-y-3" action="{{ route('expenses.store') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                <input type="text" name="titre"
                    class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 text-xs focus:outline-none focus:border-[#0f4c4c]"
                    placeholder="Titre *" required>
                <div class="grid grid-cols-2 gap-3">
                    <input type="number" step="0.01" name="montant"
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 text-xs focus:outline-none focus:border-[#0f4c4c]"
                        placeholder="Montant *" required>
                    <select name="categorie_id" required
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 text-xs focus:outline-none focus:border-[#0f4c4c]">
                        <option value="" disabled selected>Sélectionner une catégorie</option>
                        @foreach ($colocation->categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nom_categorie }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-[#0f4c4c] text-white text-xs font-semibold hover:opacity-90 transition">
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
