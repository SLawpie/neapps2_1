@extends('layouts.app')

@section('header')
<div class="flex">
    <div class="h-6 -ms-1  text-light-text-primary dark:text-dark-text-primary">
        <a href="{{ route('home') }}">
            <x-icons.chevron-double-left class="pe-2"/>
        </a>
    </div>
    <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
        Zarządzanie uprawnieniami
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
                    <div class="items-center justify-between w-full">
                        <div class="font-bold text-xl pe-2">
                            Wykaz uprawnień: 
                        </div>
                        <div class="flex flex-row py-2">
                            <a href="{{ route('admin.permission.create') }}">
                                <x-button>
                                    Dodaj nowe
                                </x-button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="items-center px-4 pb-4 sm:px-6"> 

                    @foreach ($permissions as $permission)
                        <div class="flex flex-row w-full items-center py-1 hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70 rounded-md ">
                                <div class="ps-2 pe-4">{{ $loop->index + 1 }}.</div>
                                <div class="grow">
                                    <div class="sm:flex sm:flex-row">
                                        <div>{{ $permission->name }}</div>
                                        <div class="opacity-50">[id: {{ $permission->id }}, guard: {{ $permission->guard_name }}]</div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.permission.show', Crypt::encryptString($permission->id)) }}">
                                    <div class="flex flex-row px-4 py-1 w-20 justify-center rounded-md uppercase text-xs hover:bg-light-accent dark:hover:bg-dark-accent hover:text-dark-text-primary hover:font-semibold">
                                        Pokaż
                                    </div>
                                </a>
                                <a href="{{ route('admin.permission.delete', Crypt::encryptString($permission->id)) }}">
                                    <div class="flex flex-row px-4 py-1 w-20 justify-center rounded-md uppercase text-xs hover:bg-red-500 hover:text-dark-text-primary hover:font-semibold">
                                        Usuń
                                    </div>
                                </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection