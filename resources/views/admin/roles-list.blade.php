@extends('layouts.app')

@section('header')
    <x-admin-header />
@endsection

@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                <x-button>Edytuj</x-button>
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