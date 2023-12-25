<div class="flex flex-row text-xl 
    bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary
    ">
    <div class="font-semibold leading-tight">
        {{ Auth::user()->firstname }}. 
    </div>
    <div class="hidden sm:block ps-2 font-medium">
        {{ __('dashboard.goodtoseeyou') }}
    </div>
    <div class="sm:hidden ps-2 font-medium">
        {{ __('dashboard.welcome') }}
    </div>
</div>