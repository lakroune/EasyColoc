<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Tableau de bord</h1>
        <p class="text-gray-400 text-xs mt-0.5">Bienvenue, {{ Auth::user()->name }}</p>
    </x-slot>

    <div class="space-y-6">
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-gray-100 ">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-wallet text-emerald-600 text-xs"></i>
                    </div>
                    <span class="text-xxs text-gray-400">Mon solde</span>
                </div>
                <p class="text-lg font-semibold text-gray-800">+45.50 €</p>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 ">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-receipt text-blue-600 text-xs"></i>
                    </div>
                    <span class="text-xxs text-gray-400">Ce mois</span>
                </div>
                <p class="text-lg font-semibold text-gray-800">245.00 €</p>
            </div>
            </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-5">
                <h3 class="font-semibold text-gray-800 text-sm mb-4">Activité récente</h3>
                </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-5">
                <h3 class="font-semibold text-gray-800 text-sm mb-4">Actions rapides</h3>
                </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-800 text-sm mb-4">Dépenses par catégorie</h3>
            <div class="h-48">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('expenseChart'), {
            type: 'doughnut',
            data: {
                labels: ['Alimentation', 'Logement', 'Transports', 'Loisirs', 'Autres'],
                datasets: [{
                    data: [35, 25, 15, 15, 10],
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
    @endpush
</x-app-layout>