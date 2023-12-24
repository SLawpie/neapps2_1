<div {{ $attributes->merge(['class' => " bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary 
    shadow-sm sm:rounded-lg
    "]) }}>
    <div class="sm:flex items-center px-2 py-4 sm:px-4">
        <div class="w-full">
            <div class="text-base font-bold pb-2">
                Użtkowincy:
            </div>
            <div class="flex flex-row px-2 items-center rounded-lg hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70 cursor-pointer">
                <div class="w-8 sm:w-16 text-light-text-secondary/50 dark:text-dark-text-secondary/50">
                    <x-icons.user-circle class=""/>
                </div>
                <div class="px-2">
                    <div class="font-semibold">
                        username
                    </div>
                    <div class="opacity-50">
                        imię i nazwisko
                    </div>
                </div>
                <div class="hidden sm:flex grow justify-end">
                    admin
                </div>
            </div>
            <div class="flex flex-row px-2 items-center rounded-lg hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70 cursor-pointer">
                <div class="w-8 sm:w-16 text-light-text-secondary/50 dark:text-dark-text-secondary/50">
                    <x-icons.user-circle class=""/>
                </div>
                <div class="px-2">
                    <div class="font-semibold">
                        username
                    </div>
                    <div class="opacity-50">
                        imię i nazwisko
                    </div>
                </div>
                <div class="hidden sm:flex grow justify-end">
                    user
                </div>
            </div>
            <div class="p-2"></div>
            <div class="flex justify-center p-2 rounded-lg hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70 cursor-pointer">
                pokaż wszystkich
            </div>
        </div>
    </div>
</div>