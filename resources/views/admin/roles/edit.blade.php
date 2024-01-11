@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-admin-home-link />
        <x-path-link :href="route('admin.roles.index')">
            <x-icons.chevron-double-left />
        </x-path-link>
        <x-icons.dot class="-ms-1"/>
        <x-path-link :href="route('admin.roles.show', Crypt::encryptString($role->id))">
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
    <form method="POST" action="{{ route('admin.roles.update', Crypt::encryptString($role->id)) }}">
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
                            <div class="font-bold pe-2">Edycja roli: </div>
                            <div class="font-mono">{{ $role->name }}</div>
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
                        value="{{ $role->name }}"
                        autofocus
                    />
                </div>
                <div class="sm:hidden items-center px-4 pt-4 pb-6 sm:px-6">
                    <x-button>
                        Zapisz
                    </x-button>
                </div>

                <div class="px-4 py-4 sm:px-6">
                    <div class="pe-4"> 
                        Uprawnienia:
                    </div>
                    <div>
                        @if (count($permissions) <> 0)
                            @foreach ($permissions as $permission)
                                <div class="ps-4 font-mono flex items-center"> 
                                    <input type="checkbox" name="{{ $permission->id }}" value="p-{{ $permission->id }}"
                                    @php
                                        echo ($role->hasPermissionTo($permission->name)) ? "checked" : "";
                                    @endphp
                                    >
                                    <p class="ps-2">{{ $permission->name }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="font-mono font-semibold text-red-500"> 
                                brak przypisanych uprawnień
                            </div>  
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </form>
    </div>
@endsection