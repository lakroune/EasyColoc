<x-guest-layout>
    <div class="glass-form   -3xl p-8 w-full max-w-sm shadow-2xl">
        <div class="text-center mb-6">
            <h2 class="text-teal-800 font-semibold text-lg mb-1">Nouveau mot de passe</h2>
            <p class="text-gray-400 text-xs">Veuillez définir votre nouveau mot de passe</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                       class="input-field w-full px-4 py-3.5 bg-gray-100 border border-gray-200   -xl text-xs text-gray-500 cursor-not-allowed">
                @error('email') <p class="text-red-500 text-xxs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input type="password" name="password" required placeholder="Nouveau mot de passe *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }}   -xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
                @error('password') <p class="text-red-500 text-xxs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input type="password" name="password_confirmation" required placeholder="Confirmer mot de passe *"
                       class="input-field w-full px-4 py-3.5 bg-gray-50 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-200' }}   -xl text-xs text-gray-700 focus:outline-none focus:border-teal-500">
            </div>

            <button type="submit" 
                    class="w-full py-3.5 bg-emerald-400 hover:bg-emerald-500 text-teal-900 text-xs font-semibold   -xl transition transform hover:scale-[1.02] shadow-lg shadow-emerald-400/30 mt-2">
                Réinitialiser le mot de passe
            </button>
        </form>
    </div>
</x-guest-layout>