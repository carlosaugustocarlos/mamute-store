@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-md bg-blue-50 px-4 py-2 text-start text-sm font-semibold text-blue-700 transition'
            : 'block w-full rounded-md px-4 py-2 text-start text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
