<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 text-start text-xs leading-5 text-teal-900 
                hover:bg-teal-50 focus:outline-none focus:bg-teal-50 
                transition duration-150 ease-in-out cursor-pointer'
]) }}>
    {{ $slot }}
</a>