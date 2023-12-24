<div {{ $attributes->merge(['class' => " bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary 
    shadow-sm sm:rounded-lg
    "]) }}>
    <div class="sm:flex items-center px-2 py-4 sm:px-4">
        <div class="w-full">
            <div class="text-base font-bold pb-4">
                Użtkowincy:
            </div>
            <div class="flex flex-row items-center rounded-lg hover:bg-light-bg-primary/50 cursor-pointer">
                <div class="w-16 text-light-text-secondary/50 dark:text-dark-text-secondary/50">
                    <x-icons.user-circle class=""/>
                </div>
                <div class="ps-2">
                    <div class="font-semibold">
                        username
                    </div>
                    <div class="opacity-50">
                        imię i nazwisko
                    </div>
                </div>
            </div>
            <div class="flex flex-row items-center rounded-lg hover:bg-light-bg-primary/50 cursor-pointer">
                <div class="w-16 text-light-text-secondary/50 dark:text-dark-text-secondary/50">
                    <x-icons.user-circle class=""/>
                </div>
                <div class="ps-2">
                    <div class="font-semibold">
                        username
                    </div>
                    <div class="opacity-50">
                        imię i nazwisko
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>