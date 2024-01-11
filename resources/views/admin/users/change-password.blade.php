@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-admin-home-link />
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
    <form method="POST" action="{{ route('admin.users.change-password', Crypt::encryptString($user->id)) }}">
        @csrf

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('layouts.partials.massages')

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
                    text-light-text-primary dark:text-dark-text-primary 
                    shadow-sm sm:rounded-lg
                    ">
                <div class="sm:flex px-4 py-6 sm:px-6"> 
                    <div class="sm:flex flex-row items-center justify-between w-full">
                        <div class="text-xl">
                            <span class="font-bold">Nazwa użytkownika: </span>
                            <span class="font-mono ps-2">{{ $user->username }}</span>
                            <div class="text-base opacity-50">ID: {{ $user->id }}</div>
                        </div>
                        <div class="flex flex-row">
                            <x-button>
                                zmień hasło
                            </x-button>
                        </div>
                    </div>
                </div>
                <div class="flex w-full px-4 pb-4">
                    <div class="ps-8">
                        <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                            <div class="pe-4 sm:min-w-40">
                                Nowe hasło:
                            </div>
                            <x-input 
                                required
                                id="newpassword"
                                type="password" 
                                name="newpassword" 
                                class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                placeholder="podaj nowe hasło"
                                autofocus
                            />
                        </div>
                        <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                            <div class="pe-4 sm:min-w-40">
                                Potwierdź hasło:
                            </div>
                            {{-- <div class="pe-4 font-mono font-semibold">
                                {{ $user->lasttname}}
                            </div> --}}
                            <x-input 
                                id="confirm-newpassword"
                                type="password" 
                                name="confirm-newpassword" 
                                class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                placeholder="potwierdź hasło"
                            />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    </div>
@endsection