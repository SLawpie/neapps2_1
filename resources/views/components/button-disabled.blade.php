<button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-light-accent dark:bg-dark-accent border border-transparent rounded-md font-semibold text-xs text-dark-text-primary uppercase tracking-widest ring-light-accent dark:ring-dark-accent opacity-25 cursor-default']) }}>
    {{ $slot }}
</button>