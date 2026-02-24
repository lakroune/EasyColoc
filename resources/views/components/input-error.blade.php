@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[10px] text-red-500 font-medium space-y-0.5 mt-1 animate-in fade-in slide-in-from-top-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1.5">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif