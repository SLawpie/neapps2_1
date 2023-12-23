@extends('layouts.guest')

@section('content')
<div class="flex flex-wrap h-screen justify-center">
        <div class="flex w-full justify-end 
            pt-2 pe-6
            ">
            Pstryczek
        </div>
        <div class="flex flex-row -mt-8">
            <a href="">
                <div class="text-light-bg-primary dark:text-dark-bg-secondary 
                    text-6xl sm:text-9xl
                    engraved
                    ">
                    {{config('app.name')}}&sup2;
                </div>
            </a>
        </div>
</div>
@endsection