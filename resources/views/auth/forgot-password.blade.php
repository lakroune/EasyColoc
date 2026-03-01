<x-guest-layout>
    <div class="glass-form   -3xl p-8 w-full max-w-sm shadow-2xl">
        <div class="text-center mb-6">
            <h2 class="text-teal-800 font-semibold text-lg mb-1">Mot de passe oublié ?</h2>
            <p class="text-gray-400 text-xs leading-relaxed">
                Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-xs text-emerald-600 bg-emerald-50 p-3   -lg text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="Adresse email *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}   -xl text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:bg-white">
                
                @error('email')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full py-3.5 bg-emerald-400 hover:bg-emerald-500 text-teal-900 text-xs font-semibold   -xl transition transform hover:scale-[1.02] shadow-lg shadow-emerald-400/30">
                Envoyer le lien de réinitialisation
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 text-xxs font-semibold">
                Retour à la connexion
            </a>
        </div>
    </div>
</x-guest-layout>