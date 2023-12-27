@extends('layouts.app')

@section('header')
<div class="flex">
    <div class="h-6 -ms-1  text-light-text-primary dark:text-dark-text-primary">
        <a href="{{ route('home') }}">
            <x-icons.chevron-double-left class="pe-2"/>
        </a>
    </div>
    <div class="h-6 -ms-1  text-light-text-primary dark:text-dark-text-primary">
        <a href="{{ route('admin.permissions.index') }}">
            <x-icons.chevron-double-left class="pe-2"/>
        </a>
    </div>
    <div class="h-6 -ms-1  text-light-text-primary dark:text-dark-text-primary">
        <a href="{{ route('admin.permissions.show', Crypt::encryptString($permission->id)) }}">
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
    <form method="POST" action="{{ route('admin.permissions.update', Crypt::encryptString($permission->id)) }}">
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
                            <div class="font-bold pe-2">Edycja uprawnienia: </div>
                            <div class="font-mono">{{ $permission->name }}</div>
                        </div>
                        <div class="hidden sm:flex flex-row">
                            <x-button>
                                Zapisz
                            </x-button>
                        </div>
                    </div>
                </div>
                <div class="items-center px-4 pt-4 pb-6 sm:px-6">
                    <div class="pe-4 pb-2 text-base"> 
                       Zmiana nazwy:
                    </div>
                    <x-input 
                        id="new-name"
                        type="text" 
                        name="new-name" 
                        class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                        placeholder="nazwa uprawnienia"
                        value="{{ $permission->name }}"
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