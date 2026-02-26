<button {{ $attributes->merge([
    'type' => 'button', 
    'class' => 'inline-flex items-center justify-center px-6 py-3 
                bg-white/40 border border-teal-100 -xl 
                font-semibold text-xs text-teal-800 uppercase tracking-widest 
                -sm backdrop-blur-md
                hover:bg-teal-50 hover:border-teal-200 
                focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 
                disabled:opacity-25 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>