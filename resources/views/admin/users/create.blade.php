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
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('layouts.partials.massages')

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
                    text-light-text-primary dark:text-dark-text-primary 
                    shadow-sm sm:rounded-lg
                    ">
                <div class="sm:flex px-4 pt-6 sm:px-6"> 
                    <div class="sm:flex flex-row items-center justify-between w-full">
                        <div class="sm:flex flex-row text-xl pb-4">
                            <div class="font-bold pe-2">
                                Nowy użytkownik: 
                            </div>
                        </div>
                        <div class="hidden sm:flex flex-row">
                            <x-button>
                                Zapisz
                            </x-button>
                        </div>
                    </div>
                </div>
                <div class="sm:flex px-4 pt-4 pb-2 sm:px-6">
                    <div class="pe-4 sm:min-w-80">
                        <div class="pe-4 text-base"> 
                            Nazwa użytkownika:
                        </div>
                        <div class="pb-2 text-sm opacity-50">
                            dozwolone są: małe/duże litery oraz cyfry
                        </div>
                    </div>
                    <x-input 
                        required
                        id="new-username"
                        type="text" 
                        name="new-username" 
                        class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                        placeholder="nazwa użytkownika"
                        autofocus
                    />
                </div>
                <div class="sm:flex px-4 pb-2 sm:px-6">
                    <div class="pe-4 sm:min-w-80">
                        <div class="pe-4 text-base"> 
                            Imię:
                        </div>
                        <div class="pb-2 text-sm opacity-50">
                            dozwolone są: małe/duże litery
                        </div>
                    </div>
                    <x-input
                        required
                        id="new-firstname"
                        type="text" 
                        name="new-firstname" 
                        class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                        placeholder="podaj imię"
                    />
                </div>
                <div class="sm:flex px-4 pb-2 sm:px-6">
                    <div class="pe-4 sm:min-w-80">
                        <div class="pe-4 text-base"> 
                            Nazwisko:
                        </div>
                        <div class="pb-2 text-sm opacity-50">
                            dozwolone są: małe/duże litery
                        </div>
                    </div>
                    <x-input 
                        id="new-userlastname"
                        type="text" 
                        name="new-userlastname" 
                        class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                        placeholder="podaj nazwisko"
                    />
                </div>
                <div class="sm:flex px-4 pb-2 sm:px-6">
                    <div class="pe-4 sm:min-w-80">
                        <div class="pe-4 text-base"> 
                            Adres e-mail:
                        </div>
                        <div class="pb-2 text-sm opacity-50">
                            &nbsp;
                        </div>
                    </div>
                    <x-input
                        required
                        id="new-email"
                        type="email" 
                        name="new-email" 
                        class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                        placeholder="podaj e-mail"
                    />
                </div>
                <div class="sm:flex px-4 pb-2 sm:px-6">
                    <div class="pe-4 sm:min-w-80">
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
                        placeholder="podaj hasło"
                    />
                </div>
                <div class="sm:flex px-4 pb-6 sm:px-6">
                    <div class="pe-4 sm:min-w-80">
                        <div class="pe-4 text-base"> 
                            Potwierdź hasło:
                        </div>
                        <div class="pb-2 text-sm opacity-50"></div>
                    </div>
                    <x-input
                        required
                        id="confirm-newpassword"
                        type="password" 
                        name="confirm-newpassword" 
                        class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                        placeholder="potwierdź hasło"
                    />
                </div>
                <div class=" sm:hidden items-center px-4 pt-4 pb-6 sm:px-6">
                    <x-button>
                        Zapisz
                    </x-button>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection