@props(["first" => false])

<div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
    <x-path-link :href="route('home')">
        <x-icons.home />
    </x-path-link>
    @if (!$first)    
        <x-icons.dot />
        <x-path-link :href="route('medical-reports.index')">
            <x-icons.chevron-double-left />
        </x-path-link>
    @endif    
    <x-icons.dot />
    <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
        leading-tighttext-xl 
        text-light-text-primary dark:text-dark-text-primary 
        ">
        {{ __('medical-reports.name') }}
    </div>
</div>