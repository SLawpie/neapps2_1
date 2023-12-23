@extends('layouts.guest')

@section('content')
    <div class="flex h-screen items-center justify-center">
        <a href="">
            <div class="text-light-bg-primary dark:text-dark-bg-secondary 
                text-6xl sm:text-9xl
                engraved
                ">
                {{config('app.name')}}&sup2;
            </div>
        </a>
    </div>
@endsection