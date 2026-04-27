@props(['type' => 'info'])

@php
$colors = [
    'info' => 'bg-blue-100 text-blue-700',
    'success' => 'bg-green-100 text-green-700',
    'warning' => 'bg-yellow-100 text-yellow-700',
    'danger' => 'bg-red-100 text-red-700'
];
@endphp

<span {{ $attributes->merge([
'class' => $colors[$type] . ' px-2 py-1 rounded text-sm font-medium'
]) }}>
{{ $slot }}
</span>