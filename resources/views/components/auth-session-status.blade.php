@props(['status'])

@if ($status)
    <div {{ $attributes->merge([
        'class' => 'flex items-center gap-2 p-3.5 mb-4 text-xs font-medium text-emerald-700 bg-emerald-50/80 border border-emerald-100 -xl backdrop-blur-sm'
    ]) }}>
        <i class="fas fa-check-circle text-emerald-500"></i>
        <span>{{ $status }}</span>
    </div>
@endif