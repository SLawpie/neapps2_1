@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-path-link :href="route('home')">
            <x-icons.home />
        </x-path-link>
        <x-icons.dot />
        <x-path-link :href="route('admin.roles.index')">
            <x-icons.chevron-double-left />
        </x-path-link>
        <x-icons.dot class="-ms-1"/>
        
        <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
            Zarządzanie rolami
        </h2>
    </div>
@endsection

@section('content')
    <div class="pt-8">
    <form method="POST" action="{{ route('admin.roles.store') }}">
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
                                Nowa rola: 
                            </div>
                        </div>
                        <div class="hidden sm:flex flex-row">
                            <x-button>
                                Zapisz
                            </x-button>
                        </div>
                    </div>
                </div>
                <div class="items-center px-4 pt-4 pb-6 sm:px-6">
                    <div class="pe-4 text-base"> 
                       Nazwa:
                    </div>
                    <div class="pb-2 text-sm opacity-50">
                        dozwolone są: małe/duże litery, '-', '_'
                    </div>
                    <x-input 
                        id="new-name"
                        type="text" 
                        name="new-name" 
                        class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                        placeholder="nazwa roli"
                        autofocus
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