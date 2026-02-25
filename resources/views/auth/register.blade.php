<x-guest-layout>
    <div class="glass-form rounded-3xl p-8 w-full max-w-sm shadow-2xl">
        <div class="text-center mb-6">
            <h2 class="text-teal-800 font-semibold text-lg mb-1">Créer un compte</h2>
            <p class="text-gray-400 text-xs">Rejoignez EasyColoc</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <input type="text" name="nom" value="{{ old('nom') }}" required autofocus placeholder="Nom  *"
                    class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('nom') ? 'border-red-500' : 'border-gray-200' }} rounded-xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
                @error('nom')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>  

            <div>
                <input type="text" name="prenom" value="{{ old('prenom') }}" required autofocus
                    placeholder="Prenom *"
                    class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('prenom') ? 'border-red-500' : 'border-gray-200' }} rounded-xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
                @error('prenom')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Adresse email *"
                    class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
                @error('email')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="password" name="password" required placeholder="Mot de passe *"
                    class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} rounded-xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
                @error('password')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="password" name="password_confirmation" required placeholder="Confirmer mot de passe *"
                    class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-200' }} rounded-xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-emerald-400 hover:bg-emerald-500 text-teal-900 text-xs font-semibold rounded-xl transition transform hover:scale-[1.02] shadow-lg shadow-emerald-400/30 mt-4">
                S'inscrire
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-400 text-xxs">
                Déjà inscrit ?
                <a href="{{ route('login') }}"
                    class="text-teal-600 hover:text-teal-700 font-semibold">Connectez-vous</a>
            </p>
        </div>
    </div>
</x-guest-layout>
