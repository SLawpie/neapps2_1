<div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
    <x-path-link :href="route('home')">
        <x-icons.home />
    </x-path-link>
    <x-icons.dot />
    <a class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
        font-semibold text-xl 
        text-light-text-primary dark:text-dark-text-primary 
        leading-tight"
        href="{{ route('medical-reports.index') }}">
        {{ __('medical-reports.name') }}
    </a>
</div>