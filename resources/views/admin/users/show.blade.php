@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-path-link :href="route('home')">
            <x-icons.home />
        </x-path-link>
        <x-icons.dot />
        <x-path-link :href="route('admin.users.index')">
            <x-icons.chevron-double-left />
        </x-path-link>
        <x-icons.dot class="-ms-1"/>
        
        <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
            Zarządzanie użytkownikmi
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
                <div class="sm:flex px-4 pt-6 sm:px-6"> 
                    <div class="sm:flex flex-row items-center justify-between w-full">
                        <div class="text-xl">
                            <span class="font-bold">Nazwa użytkownika: </span>
                            <span class="font-mono ps-2">{{ $user->username }}</span>
                            <div class="text-base opacity-50">ID: {{ $user->id }}</div>
                        </div>
                        <div class="flex flex-row">
                            <a href="{{ route('admin.users.index', Crypt::encryptString($user->id)) }}">
                                <x-button>
                                    Edytuj
                                </x-button>
                            </a>
                            <div class="px-2">
                                <a href="{{ route('admin.users.index', Crypt::encryptString($user->id)) }}">
                                    <x-button-red disabled >Usuń</x-button-red>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row px-4 pb-4 sm:px-6">
                    <div class="pe-4 opacity-50"> 
                        przypisane role:
                    </div>
                    <div>
                        @if (count($roles) <> 0)
                            @foreach ($roles as $role)
                                <div class="font-mono"> 
                                    {{ $role }}
                                </div>
                            @endforeach
                        @else
                            <div class="font-mono font-semibold text-red-500"> 
                                brak przypisanej roli
                            </div>  
                        @endif
                    </div>
                </div>
                <div class="flex w-full px-4">
                    <div class="h-28 w-28">
                        <x-icons.user class="fill-light-bg-primary dark:fill-dark-bg-primary"/>
                    </div>
                    <div class="ps-8">
                        <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                            <div class="pe-4 sm:min-w-40">
                                Imię:
                            </div>
                            <div class="pe-4 font-mono font-semibold">
                                {{ $user->firstname}}
                            </div>
                        </div>
                        <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                            <div class="pe-4 sm:min-w-40">
                                Nazwisko:
                            </div>
                            <div class="pe-4 font-mono font-semibold">
                                {{ $user->lasttname}}
                            </div>
                        </div>
                        <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                            <div class="pe-4 sm:min-w-40">
                                e-mail:
                            </div>
                            <div class="pe-4 font-mono font-semibold">
                                {{ $user->email}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection