@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block w-full ps-3 pe-4 py-3 border-l-4 border-teal-600 text-start text-sm font-semibold text-teal-900 bg-teal-50 focus:outline-none focus:text-teal-900 focus:bg-teal-100 focus:border-teal-700 transition duration-150 ease-in-out'
    : 'block w-full ps-3 pe-4 py-3 border-l-4 border-transparent text-start text-sm font-medium text-gray-600 hover:text-teal-800 hover:bg-teal-50 hover:border-teal-300 focus:outline-none focus:text-teal-800 focus:bg-teal-50 focus:border-teal-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>