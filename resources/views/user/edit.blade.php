@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-path-link :href="route('user.show')">
            <x-icons.chevron-double-left />
        </x-path-link>
        <x-icons.dot class="-ms-1"/>
        <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
            Edycja informacji o profilu
        </h2>
    </div>
@endsection


@section('content')
    <div class="pt-8">
    <form method="POST" action="{{ route('user.update') }}">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('layouts.partials.massages')

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary shadow-sm sm:rounded-lg">
                <div class="sm:flex items-center px-4 py-6 sm:px-6 border-dark-bg">
                    <div class="sm:flex-none w-full">
                        <div class="flex justify-between mb-4">
                            <div class="text-xl font-bold pb-4">
                                Informacje podstawowe
                            </div>
                            <div>
                                <x-button>
                                    Zapisz
                                </x-button>
                            </div>
                        </div>

                        <div class="flex justify-center w-full">
                            <div class="flex flex-row w-full lg:w-5/6 xl:w-3/4 ps-4 sm:ps-0">
                                <div class="h-28 w-28 lg:basis-1/4 xl:basis-1/3">
                                    <x-icons.user class="fill-light-bg-primary dark:fill-dark-bg-primary"/>
                                </div>
                                <div class="grow">
                                    <div class="grid grid-cols-1 gap-y-1 lg:gap-y-4 lg:grid-cols-2">
                                            
                                            <div class="font-bold">
                                                Nazwa
                                            </div>
                                            <x-input 
                                                id="new-username"
                                                type="text" 
                                                name="new-username" 
                                                class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                                placeholder="nazwa użytkownika"
                                                value="{{ Auth::user()->username }}"

                                            />
                                            <input id="username" name="username" value="{{ Auth::user()->username }}" type="hidden">

                                            <div class="font-bold">
                                                Imię
                                            </div>
                                            <x-input 
                                                id="new-firstname"
                                                type="text" 
                                                name="new-firstname" 
                                                class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                                placeholder="podaj imię"
                                                value="{{ Auth::user()->firstname }}"
                                            />
                                            <input id="firstname" name="firstname" value="{{ Auth::user()->firstname }}" type="hidden">

                                            <div class="font-bold">
                                                Nazwisko
                                            </div>
                                            <x-input 
                                                id="new-lastname"
                                                type="text" 
                                                name="new-lastname" 
                                                class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                                placeholder="podaj nazwisko"
                                                value="{{ Auth::user()->lastname }}"
                                            />
                                            <input id="lastname" name="lastname" value="{{ Auth::user()->lastname }}" type="hidden">

                                            <div class="font-bold">
                                                Adres e-mail
                                            </div>
                                            {{-- <x-input
                                                id="lastname"
                                                type="text" 
                                                name="lastname" 
                                                class="h-10 placeholder:text-light-text-primary dark:placeholder:text-dark-text-primary"
                                                placeholder="{{ Auth::user()->email }}"
                                            /> --}}
                                            <div class="">
                                                {{ Auth::user()->email }}
                                            </div>

                                            <div class="font-bold"></div>
                                            <div class="flex justify-center mt-2">
                                                <a href="{{ route('user.change-password-form') }}">
                                                    <x-button type="button">
                                                        Zmiana hasła
                                                    </x-button>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> 

        </div>
    </form>
    </div>
@endsection