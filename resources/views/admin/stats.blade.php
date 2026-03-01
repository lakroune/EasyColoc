<x-app-layout>
    <div class="h-[calc(100vh-80px)] p-6 bg-gray-50">
        <div class="max-w-7xl mx-auto h-full flex flex-col gap-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <div class="bg-white p-4 border border-gray-100  -xl flex items-center gap-3    -sm">
                    <div class="w-10 h-10 bg-blue-50  -lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-medium">Utilisateurs</p>
                        <p class="text-xl font-semibold text-gray-800">{{ number_format($data['total_users']) }}</p>
                    </div>
                </div>

                <div class="bg-white p-4 border border-gray-100  -xl flex items-center gap-3    -sm">
                    <div class="w-10 h-10 bg-purple-50  -lg flex items-center justify-center">
                        <i class="fas fa-home text-purple-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-medium">Colocations</p>
                        <p class="text-xl font-semibold text-gray-800">{{ number_format($data['total_colocations']) }}</p>
                    </div>
                </div>

                <div class="bg-white p-4 border border-gray-100  -xl flex items-center gap-3    -sm">
                    <div class="w-10 h-10 bg-emerald-50  -lg flex items-center justify-center">
                        <i class="fas fa-wallet text-emerald-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-medium">Flux Total</p>
                        <p class="text-xl font-semibold text-emerald-600">
                            {{ number_format($data['total_money'], 2) }} <span class="text-xs">DH</span>
                        </p>
                    </div>
                </div>

                <div class="bg-white p-4 border border-gray-100  -xl flex items-center gap-3    -sm">
                    <div class="w-10 h-10 bg-orange-50  -lg flex items-center justify-center">
                        <i class="fas fa-paper-plane text-orange-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-medium">Invitations Actives</p>
                        <p class="text-xl font-semibold text-gray-800">{{ number_format($data['active_invitations']) }}</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 grid grid-cols-1 lg:grid-cols-3 gap-4">
                
                <div class="lg:col-span-2 bg-white border border-gray-100  -xl flex flex-col overflow-hidden    -sm">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                        <h2 class="font-semibold text-gray-800 text-xs uppercase tracking-wider">Dernières Dépenses</h2>
                    </div>
                    <div class="flex-1 overflow-y-auto p-4">
                        <div class="space-y-3">
                            @forelse($data['recent_expenses'] as $expense)
                                <div class="flex items-center gap-3 p-3 bg-gray-50  -lg">
                                    <div class="w-8 h-8 bg-emerald-100  -full flex items-center justify-center text-emerald-600 text-xs">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-gray-800 font-medium">{{ $expense->description ?? 'Dépense' }}</p>
                                        <p class="text-[10px] text-gray-400">
                                            {{ $expense->colocationUser->user->nom }} - 
                                            {{ number_format($expense->montant, 2) }} DH - 
                                            {{ $expense->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500 text-sm py-4">Aucune dépense récente.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100  -xl flex flex-col overflow-hidden    -sm">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                        <h2 class="font-semibold text-gray-800 text-xs uppercase tracking-wider">État des utilisateurs</h2>
                    </div>
                    <div class="flex-1 p-4 flex flex-col justify-center items-center text-gray-400">
                        <div class="w-24 h-24  -full border-4 border-gray-100 border-t-[#0f4c4c] flex items-center justify-center mb-3">
                            <span class="text-lg font-semibold text-gray-800">{{ number_format($data['total_users']) }}</span>
                        </div>
                        <p class="text-[11px]">Total utilisateurs</p>
                        
                        <div class="mt-4 w-full space-y-2">
                            <div class="flex justify-between text-[10px]">
                                <span class="text-gray-500">Actifs</span>
                                <span class="font-medium text-gray-800">{{ number_format($data['active_users']) }}</span>
                            </div>
                            <div class="w-full bg-gray-100  -full h-1.5">
                                <div class="bg-[#0f4c4c] h-1.5  -full" style="width: {{ $data['total_users'] > 0 ? ($data['active_users'] / $data['total_users']) * 100 : 0 }}%"></div>
                            </div>
                            
                            <div class="flex justify-between text-[10px]">
                                <span class="text-gray-500">Bannis</span>
                                <span class="font-medium text-red-600">{{ number_format($data['banned_users']) }}</span>
                            </div>
                            <div class="w-full bg-gray-100  -full h-1.5">
                                <div class="bg-red-500 h-1.5  -full" style="width: {{ $data['total_users'] > 0 ? ($data['banned_users'] / $data['total_users']) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>