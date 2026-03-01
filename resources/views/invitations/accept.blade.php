<x-guest-layout>
    <div class="  flex flex-col items-center justify-center bg-gray-50 p-4">
        <div class="max-w-md w-full bg-white   -3xl border border-gray-100   p-8 text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Invitation reçue !</h1>
            <p class="text-gray-500 text-sm mb-8">
                Vous avez été invité à rejoindre une colocation sur <span
                    class="text-[#0f4c4c] font-semibold">EasyColoc</span>.
            </p>
            <div class="space-y-3">
                <form action=" " method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full py-3.5 bg-[#0f4c4c] text-white    text-sm font-semibold hover:opacity-90 transition ">
                        Accepter et rejoindre
                    </button>
                </form>
            </div>
            <p class="mt-8 text-[10px] text-gray-400">
                En acceptant, vous aurez accès aux dépenses et au solde de cette colocation.
            </p>
        </div>
    </div>
</x-guest-layout>
