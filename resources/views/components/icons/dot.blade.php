@props(['fill' => 'currentColor'])

<svg xmlns="http://www.w3.org/2000/svg"
    {{ $attributes->merge(['fill' => $fill, 'class' => 'h-full']) }}
    viewBox="0 0 24 24"
    >
    <circle cx="12" cy="12" r=2 />
</svg>  