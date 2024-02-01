<button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-dark-text-primary uppercase tracking-widest ring-red-500 dark:ring-red-500 opacity-25 cursor-default']) }}>
    {{ $slot }}
</button>