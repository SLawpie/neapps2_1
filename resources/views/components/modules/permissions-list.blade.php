<div {{ $attributes->merge(['class' => " bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary 
    shadow-sm sm:rounded-lg
    "]) }}>
    <div class="sm:flex items-center px-2 py-4 sm:px-4">
        <div class="w-full">
            <div class="text-base font-bold pb-2">
                Uprawnienia:
            </div>
            <div class="flex flex-row items-center rounded-lg hover:bg-light-bg-primary/50 cursor-pointer">
                <div class="ps-2">
                    <div class="">
                        view ussers
                    </div>
                </div>
            </div>
            <div class="flex flex-row items-center rounded-lg hover:bg-light-bg-primary/50 cursor-pointer">
                <div class="ps-2">
                    <div class="">
                        edit users
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>