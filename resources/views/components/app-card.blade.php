@props([
    'image'=>"",
    'active'=> false,
])

@if ($active)
    <div class="rounded-lg bg-light-bg-secondary dark:bg-dark-bg-secondary h-32 sm:h-64 transition ease-in-out delay-150 hover:scale-105 duration-300">
        <a {{ $attributes }}>
            <div class="h-3/4 flex flex-col place-content-center border-b-2 border-light-accent/50 dark:border-dark-accent/50">
                <div class="flex justify-center h-3/4">
                    {{ $image }}
                </div>
            </div>
            <div class="h-1/4 flex flex-col place-content-center">
                <div class="flex justify-center sm:text-xl text-light-text-primary dark:text-dark-text-primary">
                    {{ $slot }}
                </div>
            </div>
        </a>
    </div>        
@else
    <div class="rounded-lg bg-light-bg-secondary dark:bg-dark-bg-secondary h-32 sm:h-64 opacity-50">
    </div> 
@endif