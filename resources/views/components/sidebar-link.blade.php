@props(['active', 'href'])

<a href="{{ $href }}" 
   class="flex items-center gap-3 px-4 py-3 -xl transition text-xs font-medium 
   {{   'text-teal-900 hover:bg-teal-50' }}">
    {{ $slot }}
</a>