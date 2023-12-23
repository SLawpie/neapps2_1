<div class="flex flex-col items-center justify-center h-screen">
    <div class="w-full sm:max-w-md">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md px-6 py-4 bg-light-bg-primary dark:bg-dark-bg-secondary shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>