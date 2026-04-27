<div {{ $attributes->merge([
'class' => 'bg-white p-4 rounded shadow hover:shadow-md transition h-full'
]) }}>
    {{ $slot }}
</div>