<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 p-4">
        <div class="max-w-md w-full bg-white rounded-3xl border border-gray-100 shadow-sm p-8 text-center">

            <div class="w-20 h-20 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-home text-3xl text-[#0f4c4c]"></i>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-2">Invitation reçue !</h1>
            <p class="text-gray-500 text-sm mb-8">
                Vous avez été invité à rejoindre une colocation sur <span
                    class="text-[#0f4c4c] font-semibold">EasyColoc</span>.
            </p>

            <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100">
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-2 text-left">Nom de la
                    colocation</p>
            </div>

            <div class="space-y-3">
                <form action=" " method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full py-3.5 bg-[#0f4c4c] text-white rounded-2xl text-sm font-semibold hover:opacity-90 transition shadow-lg shadow-emerald-900/10">
                        Accepter l'invitation
                    </button>
                </form>

                <a href="{{ route('dashboard') }}"
                    class="block w-full py-3.5 bg-white text-gray-500 border border-gray-200 rounded-2xl text-sm font-medium hover:bg-gray-50 transition">
                    Plus tard
                </a>
            </div>

            <p class="mt-8 text-[10px] text-gray-400">
                En acceptant, vous aurez accès aux dépenses et au solde de cette colocation.
            </p>
        </div>
    </div>
</x-guest-layout>
