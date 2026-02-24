<div class="bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl p-8 shadow-xl">
    <h2 class="text-lg font-semibold text-teal-900 mb-6">{{ __('Modifier le profil') }}</h2>
    
    <form action="#" method="POST" class="space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="first_name" :value="__('Prénom')" />
                <x-text-input id="first_name" name="first_name" type="text" value="Jean" />
            </div>
            <div>
                <x-input-label for="last_name" :value="__('Nom')" />
                <x-text-input id="last_name" name="last_name" type="text" value="Dupont" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" value="jean.dupont@email.com" disabled />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" name="phone" type="tel" value="+33 6 12 34 56 78" />
        </div>

        <div class="pt-4 border-t border-teal-100/50">
            <x-primary-button class="w-full justify-center">
                {{ __('Enregistrer les modifications') }}
            </x-primary-button>
        </div>
    </form>
</div>