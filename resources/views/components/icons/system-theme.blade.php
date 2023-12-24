@props(['fill' => 'currentColor'])

<svg xmlns="http://www.w3.org/2000/svg" 
    {{ $attributes->merge(['fill' => $fill, 'class' => 'h-full']) }}
    viewBox="0 0 24 24" 
    stroke-width="1.5" 
    stroke="currentColor"
    stroke-linecap="round" 
    stroke-linejoin="round">
    <path fill="none" d="M18.364 18.364 A9 9 0 0 0 5.636 5.636" />
    <path d="M18.364 18.364 A9 9 0 0 1 5.636 5.636 L18.364 18.364 Z" />
</svg>
  