@props(['type' => 'submit'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-dark-text-primary uppercase tracking-widest hover:ring hover:bg-opacity-80 active:bg-red-500 dark:active:bg-red-500 focus:outline-none focus:border-lred-500 dark:focus:border-red-500 focus:bg-opacity-80 focus:ring ring-red-500 dark:ring-red-500 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>