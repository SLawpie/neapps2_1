@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-light-text-primary dark:text-dark-text-primary']) }}>
    {{ $value ?? $slot }}
</label>
