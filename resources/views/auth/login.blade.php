<x-guest-layout>
    @if (session('status'))
        <div class="mb-4 text-sm text-emerald-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="glass-form   -3xl p-8 w-full max-w-sm shadow-2xl">
        <div class="text-center mb-8">
            <h2 class="text-teal-800 font-semibold text-lg mb-1">Connexion</h2>
            <p class="text-gray-400 text-xs">Accédez à votre espace</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="Adresse email *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}  text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:bg-white">
                
                @error('email')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <input type="password" 
                       name="password" 
                       required 
                       placeholder="Mot de passe *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }}  text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:bg-white">
                
                @error('password')
                    <p class="text-red-500 text-xxs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-xxs">
                <label class="flex items-center gap-2 text-gray-500 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-3.5 h-3.5    border-gray-300 text-teal-600 focus:ring-teal-500">
                    <span>Se souvenir de moi</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-teal-600 hover:text-teal-700 font-medium">Mot de passe oublié ?</a>
            </div>

            <button type="submit" 
                    class="w-full py-3.5 bg-emerald-400 hover:bg-emerald-500 text-teal-900 text-xs font-semibold  transition transform hover:scale-[1.02] shadow-lg shadow-emerald-400/30">
                Se connecter
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-400 text-xxs">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-700 font-semibold">Créer un compte</a>
            </p>
        </div>
    </div>
</x-guest-layout>