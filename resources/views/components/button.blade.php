@props(['variant' => 'primary'])

@php
$styles = [
    'primary' => 'bg-green-600 text-white hover:bg-green-700',
    'danger' => 'bg-red-600 text-white hover:bg-red-700',
    'secondary' => 'border border-gray-400 text-gray-700 hover:bg-gray-100',
    'secondaryalt' => 'text-red-600 hover:bg-red-600 hover:text-white border border-red-600',
    'primaryalt' => 'text-green-600 hover:bg-green-600 hover:text-white border border-green-600',
    'dangeralt' => 'text-red-600 hover:bg-red-600 hover:text-white border border-red-600',
    'regularalt' => 'text-blue-600 hover:bg-blue-600 hover:text-white border border-blue-600',
];
@endphp

<button {{ $attributes->merge([
    'class' => $styles[$variant] . ' px-3 py-1.5 rounded-md cursor-pointer transition'
]) }}>
    {{ $slot }}
</button>