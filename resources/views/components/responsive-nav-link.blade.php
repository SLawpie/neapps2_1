@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-light-accent dark:border-dark-accent text-base font-medium text-light-accent dark:text-dark-accent bg-light-accent/20 dark:bg-dark-accent/20 focus:outline-none transition duration-150 ease-in-out'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-light-text-secondary dark:text-dark-text-secondary hover:text-light-text-primary dark:hover:text-dark-text-primary hover:bg-light-bg-primary dark:hover:bg-dark-bg-primary/30 hover:border-light-text dark:hover:border-dark-bg-primary focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
