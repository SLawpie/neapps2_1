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
    <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
        Zarządzanie uprawnieniami
    </h2>
</div>
@endsection

@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('messagetype'))
                <div id="hideMe" class="flex justify-center w-full">
                    <div class="flex w-full sm:w-3/4 pb-6">
                        <x-flash-box type="{{ session('messagetype') }}">
                            <p class="font-bold">{{ session('message') }}</p>
                        </x-flash-box>
                    </div> 
                </div>
            @endif

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
                    text-light-text-primary dark:text-dark-text-primary 
                    shadow-sm sm:rounded-lg
                    ">
                <div class="sm:flex px-4 pt-6 sm:px-6"> 
                    <div class="sm:flex flex-row items-center justify-between w-full">
                        <div class="text-xl pb-4">
                            <span class="font-bold">Uprawnienie: </span>
                            <span class="font-mono ps-2">{{ $permission->name }}</span>
                            <div class="text-base opacity-50">guard: {{ $permission->guard_name }}</div>
                            <div class="text-base opacity-50">ID: {{ $permission->id }}</div>
                        </div>
                        <div class="flex flex-row">
                            <a href="{{ route('admin.permission.edit', Crypt::encryptString($permission->id)) }}">
                                <x-button>
                                    Edytuj
                                </x-button>
                            </a>
                            <div class="px-2">
                                <a href="{{ route('admin.permission.delete', Crypt::encryptString($permission->id)) }}">
                        
                                @if (count($roles) <> 0) 
                                    <x-button-red disabled>Usuń</x-button-red>
                                @else 
                                    <x-button-red >Usuń</x-button-red>
                                @endif

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row items-center px-4 py-4 sm:px-6">
                    <div class="pe-4 opacity-50"> 
                        przypisane do ról:
                    </div>
                    <div>
                        @if (count($roles) <> 0)
                            @foreach ($roles as $role)
                                <div class="font-mono"> 
                                    {{ $role->name }}
                                </div>
                            @endforeach
                        @else
                            <div class="font-mono font-semibold text-red-500"> 
                                brak ról
                            </div>  
                        @endif
                    </div>
                </div>

                @if ($users)
                <div class="flex flex-row items-center px-4 py-4 sm:px-6">
                    <div class="pe-4 opacity-50"> 
                        przypisane do uźytkownika:
                    </div>
                    <div>

                        @foreach ($users as $user)
                            <div class="font-mono items-center"> 
                                {{ $user->username }}
                                @php
                                    $role = Spatie\Permission\Models\Role::with('users')->where('id', $user->id)->first();
                                @endphp
                                <span class="text-xs">[{{ $role->name }}]</span>
                            </div>
                        @endforeach
        
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection