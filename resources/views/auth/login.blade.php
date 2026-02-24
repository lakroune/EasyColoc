<x-guest-layout>
    <div class="glass-form rounded-3xl p-8 w-full max-w-sm shadow-2xl">
        <div class="text-center mb-8">
            <h2 class="text-teal-800 font-semibold text-lg mb-1">Connexion</h2>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Adresse email *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border rounded-xl text-xs focus:border-teal-500 outline-none">
            </div>
            <div>
                <input type="password" name="password" required placeholder="Mot de passe *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border rounded-xl text-xs focus:border-teal-500 outline-none">
            </div>
            <button type="submit" class="w-full py-3.5 bg-emerald-400 hover:bg-emerald-500 text-teal-900 text-xs font-semibold rounded-xl">
                Se connecter
            </button>
        </form>
    </div>
</x-guest-layout>