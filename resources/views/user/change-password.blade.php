@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-path-link :href="route('user.show')">
            <x-icons.chevron-double-left />
        </x-path-link>
        <x-icons.dot />
        <x-path-link :href="route('user.edit')">
            <x-icons.chevron-double-left />
        </x-path-link>
        <x-icons.dot class="-ms-1"/>
        <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
            Zmiana hasła
        </h2>
    </div>
@endsection


@section('content')
    <div class="pt-8">
        <form method="POST" action="{{ route('user.change-password', Crypt::encryptString(Auth::user()->id)) }}">
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @include('layouts.partials.massages')

                <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary shadow-sm sm:rounded-lg">
                    <div class="sm:flex items-center px-4 py-6 sm:px-6 border-dark-bg">
                        <div class="sm:flex-none w-full">
                            <div class="flex justify-between">
                                <div class="text-xl font-bold pb-4">
                                    Zmiana hasła
                                </div>
                            </div>

                            <div class="flex justify-center w-full">
                                <div class="flex flex-row w-full lg:w-3/4 xl:w-1/2 ps-4 sm:ps-0">
                                    <div class="w-full grid grid-cols-1 gap-y-1 lg:gap-y-4 lg:grid-cols-2">

                                        <div class="font-bold">
                                            Obecne hasło
                                        </div>
                                        <x-input 
                                            required 
                                            autofocus
                                            id="password"
                                            type="password" 
                                            name="password" 
                                            class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                            placeholder="obecne hasło"
                                        />

                                        <div>
                                            <div class="pe-4 text-base"> 
                                                Hasło:
                                            </div>
                                            <div class="pb-2 text-sm opacity-50">
                                                <p>Postaraj się by hasło:</p>
                                                <li>miało od 6 do 30 znaków.</li>
                                                <li>składało się z liter różnej wielkości</li>
                                                <li>składało ssię cyfr i znaków specjalnych.</li>
                                            </div>
                                        </div>
                                        <x-input 
                                            required 
                                            id="new-password"
                                            type="password" 
                                            name="new-password" 
                                            class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                            placeholder="nowe hasło"
                                        />

                                        <div class="font-bold">
                                            Potwierdź nowe hasło
                                        </div>
                                        <x-input
                                            required 
                                            id="confirm-newpassword"
                                            type="password" 
                                            name="confirm-newpassword" 
                                            class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                                            placeholder="potwierdź nowe hasło"
                                        />

                                        <div class="font-bold"></div>
                                        <div class="flex justify-center mt-2">
                                            <x-button class="w-full flex justify-center">
                                                Zmień hasło
                                            </x-button>
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