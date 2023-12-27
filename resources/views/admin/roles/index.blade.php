@extends('layouts.app')

@section('header')
<div class="flex">
    <div class="h-6 -ms-1  text-light-text-primary dark:text-dark-text-primary">
        <a href="{{ route('home') }}">
            <x-icons.chevron-double-left class="pe-2"/>
        </a>
    </div>
    <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
        Zarządzanie rolami
    </h2>
</div>
@endsection

@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('layouts.partials.massages')

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
                    text-light-text-primary dark:text-dark-text-primary 
                    shadow-sm sm:rounded-lg
                    ">
                <div class="sm:flex items-center px-4 pt-6 sm:px-6"> 
                    <div class="sm:flex-none w-full">
                        <div class="text-xl font-bold pb-4">
                            Zarządzanie rolami:
                        </div>
                    </div>
                </div>
                <div class="sm:flex items-center px-4 pb-4 sm:px-6"> 

                    @foreach ($roles as $role)
                        <div class="flex flex-row w-full items-center">
                            <div class="pe-4">{{ $loop->index + 1 }}.</div>
                            <div class="grow">
                                <span>{{ $role->name }}</span>
                                <span class="opacity-50">[{{ $role->id }}]</span>
                            </div>
                            <div class="px-2">
                                <x-button>Pokaż</x-button>
                            </div>
                            <div class="px-2">
                                <x-button-red>Usuń</x-button-red>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection