@extends('layouts.guest')

@section('content')
<div class="flex flex-wrap h-screen justify-center">
    <div class="flex w-full justify-end h-16
        pt-4 pe-6
        border-b border-light-accent dark:border-dark-accent
        ">
        <x-toggle-dark-light />
    </div>
    <div class="flex flex-row -mt-16">
        <a href="{{ route('login') }}">
            <div class="text-light-bg-primary dark:text-dark-bg-secondary 
                text-6xl sm:text-9xl
                hover:scale-110
                transition ease-in-out delay-150 duration-300
                engraved
                cursor-pointer
                ">
                {{config('app.name')}}&sup2;
            </div>
        </a>
    </div>
</div>
@endsection