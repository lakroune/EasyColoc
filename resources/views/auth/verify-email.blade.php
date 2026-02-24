<x-guest-layout>
    <div class="glass-form rounded-3xl p-8 w-full max-w-sm shadow-2xl">
        <div class="text-center mb-6">
            <h2 class="text-teal-800 font-semibold text-lg mb-1">Vérification email</h2>
            <p class="text-gray-400 text-xs leading-relaxed">
                Merci pour votre inscription ! Veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 p-3 text-xs text-center text-emerald-700 bg-emerald-50 rounded-lg">
                Un nouveau lien de vérification a été envoyé à votre adresse.
            </div>
        @endif

        <div class="flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" 
                        class="w-full py-3.5 bg-emerald-400 hover:bg-emerald-500 text-teal-900 text-xs font-semibold rounded-xl transition transform hover:scale-[1.02] shadow-lg shadow-emerald-400/30">
                    Renvoyer le lien de vérification
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-teal-700 text-xxs font-medium underline">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>