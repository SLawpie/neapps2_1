@props(['type' => 'submit'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center px-4 py-2 bg-light-accent dark:bg-dark-accent border border-transparent rounded-md font-semibold text-xs text-dark-text-primary uppercase tracking-widest hover:ring hover:bg-opacity-80 active:bg-light-accent dark:active:bg-dark-accent focus:outline-none focus:border-light-accent dark:focus:border-dark-accent focus:ring ring-light-accent dark:ring-dark-accent disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>