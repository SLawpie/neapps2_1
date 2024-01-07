@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-path-link :href="route('home')">
            <x-icons.home />
        </x-path-link>
        <x-icons.dot />
        
        <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
            Zarządzanie użytkownikami
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
                            Wykaz użytkowników:
                        </div>
                        <div class="flex flex-row py-2">
                            <a href="{{ route('admin.users.create') }}">
                                <x-button>
                                    Dodaj nowego
                                </x-button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="items-center px-4 pb-4 sm:px-6"> 

                    @foreach ($users as $user)
                        <div class="flex flex-row w-full items-center py-1 hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70 rounded-md ">
                                <div class="ps-2 pe-4">{{ $loop->index + 1 }}.</div>
                                <div class="grow">
                                    <div class="sm:flex sm:flex-row">
                                        <div>{{ $user->username }}</div>
                                        <div class="opacity-50">[id: {{ $user->id }}]</div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.users.show', Crypt::encryptString($user->id)) }}">
                                    <div class="flex flex-row px-4 py-1 w-20 justify-center rounded-md uppercase text-xs hover:bg-light-accent dark:hover:bg-dark-accent hover:text-dark-text-primary hover:font-semibold">
                                        Pokaż
                                    </div>
                                </a>
                                {{-- @if (auth()->user()->hasRole('writer')) --}}
                                @if (!$user->hasRole('super-admin') && ($user->id != auth()->user()->id) && (auth()->user()->can('delete users')))
                                    <a href="{{ route('admin.users.delete', Crypt::encryptString($user->id)) }}">
                                        <div class="flex flex-row px-4 py-1 w-20 justify-center rounded-md uppercase text-xs hover:bg-red-500 hover:text-dark-text-primary hover:font-semibold">
                                            Usuń
                                        </div>
                                    </a>
                                @else
                                    <div class="flex flex-row px-4 py-1 w-20 justify-center uppercase text-xs
                                        text-light-text-secondary dark:text-dark-text-secondary">
                                        Usuń
                                    </div>
                                @endif
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection