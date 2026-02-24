<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-900 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel p-8 rounded-3xl border border-teal-100 shadow-xl">
                <div class="flex items-center gap-4">
                    <div class="p-4 bg-teal-100 rounded-2xl">
                        <i class="fas fa-check-circle text-teal-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-teal-900">Bienvenue sur EasyColoc</h3>
                        <p class="text-sm text-teal-700/80">{{ __("Vous êtes bien connecté !") }}</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="glass-panel p-6 rounded-3xl border border-teal-100 shadow-md">
                    <h4 class="text-sm text-teal-600 font-semibold">Dépenses totales</h4>
                    <p class="text-2xl font-bold text-teal-900 mt-2">1,250 €</p>
                </div>
                <div class="glass-panel p-6 rounded-3xl border border-teal-100 shadow-md">
                    <h4 class="text-sm text-teal-600 font-semibold">Tâches en cours</h4>
                    <p class="text-2xl font-bold text-teal-900 mt-2">4</p>
                </div>
                <div class="glass-panel p-6 rounded-3xl border border-teal-100 shadow-md">
                    <h4 class="text-sm text-teal-600 font-semibold">Colocataires</h4>
                    <p class="text-2xl font-bold text-teal-900 mt-2">3</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>