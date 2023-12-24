<div {{ $attributes->merge(['class' => " bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary 
    shadow-sm sm:rounded-lg
    "]) }}>
    <div class="sm:flex items-center px-2 py-4 sm:px-4">
        <div class="w-full">
            <div class="flex flex-row px-2 items-center rounded-lg 
                hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70
                cursor-pointer">
                <div class="w-8 text-light-text-secondary/50 dark:text-dark-text-secondary/50">
                    <x-icons.bars-3-bottom-left class=""/>
                </div>
                <div class="font-semibold ps-2">
                    Role
                </div>
            </div>
            <div class="flex flex-row px-2 items-center rounded-lg 
                hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70
                cursor-pointer">
                <div class="w-8 text-light-text-secondary/50 dark:text-dark-text-secondary/50">
                    <x-icons.bars-3-bottom-left class=""/>
                </div>
                <div class="font-semibold ps-2">
                    Uprawnienia
                </div>
            </div>
        </div>
    </div>
</div>