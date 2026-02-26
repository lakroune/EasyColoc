@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'w-full px-4 py-3 bg-white/50 border border-teal-100 -xl 
                text-teal-900 text-sm placeholder-teal-600/50
                focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 
                -sm backdrop-blur-sm transition duration-200 ease-in-out'
]) }}>