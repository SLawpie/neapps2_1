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

                    </div>
                </x-slot>
            </x-auth-card>
        </div>
    </div>
</div>
@endsection