@extends('layouts.guest')

@section('content')
<div class="flex flex-wrap sm:h-screen justify-center">
    <div class="flex w-full justify-end 
        pt-4 pe-6
        ">
        <x-toggle-dark-light />
    </div>
    <div class="flex flex-row mt-8 sm:-mt-8">
        <div>
            <x-auth-card>
                <x-slot name="logo">
                    <div class="flex flex-col items-center">
                        <a href="/">
                            <x-application-logo 
                                class="w-32 h-32 fill-current mb-4  
                                text-light-text dark:text-dark-text 
                                hover:scale-110 
                                transition ease-in-out delay-150 duration-300
                                " />
                        </a>

                        @if (($errors->any()) || ((session('status'))))
                            <div id="" class="flex justify-center w-full">
                                <div class="flex w-full pb-6">
                                    <x-flash-box type="alert">
                                        @if (session('status'))
                                            <p class="font-bold">{{ session('status') }}</p>
                                        @endif
                                        @if ($errors->any())
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li class="font-bold">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </x-flash-box>
                                </div> 
                            </div>
                        @endif

                    </div>
                </x-slot>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-label 
                            for="username" 
                            :value="__('auth.user')" 
                        />

                        <x-input 
                            id="username" 
                            class="block mt-1 w-full bg-light-bg-secondary" 
                            type="text" 
                            name="username" 
                            :value="old('username')" 
                            required 
                            autofocus 
                        />
                    </div>
                </form>

            </x-auth-card>
        </div>
    </div>
</div>
@endsection