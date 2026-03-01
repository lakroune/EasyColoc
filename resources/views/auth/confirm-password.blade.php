<x-guest-layout>
    <div class="glass-form   -3xl p-8 w-full max-w-sm shadow-2xl">
        <div class="text-center mb-6">
            <h2 class="text-teal-800 font-semibold text-lg mb-1">Confirmation</h2>
            <p class="text-gray-400 text-xs leading-relaxed">
                Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe pour continuer.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
            @csrf

            <div>
                <input type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="Mot de passe *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }}   -xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
                
                @error('password')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full py-3.5 bg-emerald-400 hover:bg-emerald-500 text-teal-900 text-xs font-semibold   -xl transition transform hover:scale-[1.02] shadow-lg shadow-emerald-400/30">
                Confirmer
            </button>
        </form>
    </div>
</x-guest-layout>