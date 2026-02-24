@props(['value'])

<label {{ $attributes->merge([
    'class' => 'block text-xs font-semibold text-teal-800 mb-1.5 uppercase tracking-wide'
]) }}>
    {{ $value ?? $slot }}
</label>