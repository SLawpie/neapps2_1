@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary"><h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
            Zarządzanie kontem
        </h2>
    </div>
@endsection

@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            @include('layouts.partials.massages')

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary shadow-sm sm:rounded-lg">
                <div class="sm:flex items-center px-4 py-6 sm:px-6 border-dark-bg"> 
                    <div class="sm:flex-none w-full">
                        <div class="flex justify-between">
                            <div class="text-xl font-bold pb-4">
                                Informacje o profilu
                            </div>
                            <div>
                                <a href="{{ route('user.edit') }}">
                                    <x-button>
                                        Edytuj
                                    </x-button>
                                </a>
                            </div>
                        </div>

                        <div class="flex justify-center w-full">
                            <div class="flex flex-row w-full sm:w-3/4 ps-8 sm:ps-0">
                                <div class="h-28 w-28 sm:basis-1/3">
                                    <x-icons.user class="fill-light-bg-primary dark:fill-dark-bg-primary"/>
                                </div>
                                <div class="grow">
                                    <div class="grid grid-cols-1 sm:grid-cols-2">
                                            <div class="font-bold">
                                                Nazwa
                                            </div>
                                            <div class="pb-1 sm:pb-4">
                                                {{ Auth::user()->username }}
                                            </div>
                                            <div class="font-bold">
                                                Imię i Nazwisko
                                            </div>
                                            <div class="pb-1 sm:pb-4">
                                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                            </div>
                                            <div class="font-bold">
                                                Adres e-mail
                                                </div>
                                            <div class="pb-1">
                                                {{ Auth::user()->email }}
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> 
            <div class="py-2"></div>
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary shadow-sm sm:rounded-lg">
                <div class="sm:flex items-center px-4 py-6 sm:px-6 border-dark-bg">
                    <div class="sm:flex-none w-full">
                        <div class="text-xl font-bold pb-4">
                            Ustawienia regionalne
                        </div>
                        <div class="flex justify-center w-full">
                            <div class="flex w-full sm:w-3/4">
                                <div class="w-16 sm:grow">

                                </div>
                                <div class="basis-1/3 font-bold">
                                        Język
                                    </div>
                                <div class="grow sm:basis-1/3">
                                    polski (Polska)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary shadow-sm sm:rounded-lg">
                <div class="sm:flex items-center px-4 py-6 sm:px-6 border-dark-bg">
                    <div class="sm:flex-none w-full">
                        <div class="text-xl font-bold pb-4">
                            Wygląd ogólny
                        </div>
                        <div class="flex justify-center w-full">
                            <div class="flex w-full xl:w-1/2">
                                <div class="py-2 grid grid-cols-1 md:grid-cols-3 gap-1 w-full">
                                    <div class="pt-2 grid gap-2 justify-items-center">
                                        <div class="h-28 cursor-pointer" onclick="switchTheme('light')">
                                            <svg id="lightTheme" class="w-full h-full stroke-light-accent hover:stroke-light-text stroke-[0.75px]"
                                                viewBox="0 0 24 16"
                                                fill="#e2e8f0"
                                                stroke-width="0.25">
                                                <rect width="24" height="14" rx="1" ry="1" y="1"/>
                                            </svg>
                                        </div>
                                        <div class="flex justify-center">
                                            Jasny
                                        </div>
                                    </div>
                                    <div class="pt-2 grid gap-2 justify-items-center">
                                        <div class="h-28 cursor-pointer" onclick="switchTheme('dark')">
                                            <svg id="darkTheme" class="w-full h-full dark:stroke-dark-accent hover:stroke-light-text hover:stroke-[0.75px]"
                                                viewBox="0 0 24 16"
                                                fill="#1e293b"
                                                stroke-width="0.25">
                                                <rect width="24" height="14" rx="1" ry="1" y="1"/>
                                            </svg>
                                        </div>
                                        <div class="">
                                            Ciemny
                                        </div>
                                    </div>
                                    <div class="pt-2 grid gap-2 justify-items-center">
                                        <div class="h-28 cursor-pointer" onclick="switchTheme('system')">
                                            <svg id="systemTheme" class="w-full h-full stroke-loght-bg hover:stroke-light-text hover:stroke-[0.75px]"
                                                viewBox="0 0 24 16"
                                                stroke-width="0.25">
                                                <path
                                                    fill="#1e293b"
                                                    d="M0 2 L0 14 Q0 15 1 15 L23 15 Q24 15 24 14 L24 2 Q24 1 23 1 L1 1 Q0 1 0 2 Z"/>
                                                <path
                                                    fill="#e2e8f0"
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M0 2 Q0 1 1 1 L23 1 Q24 1 24 2 L24 14" />
                                            </svg>
                                        </div>
                                        <div class="">
                                            Motyw systemu
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary shadow-sm sm:rounded-lg">
                <div class="sm:flex items-center px-4 py-6 sm:px-6 border-dark-bg">
                    <div class="sm:flex-none w-full">
                        <div class="text-xl font-bold pb-4">
                            Ostatnia aktywność
                        </div>
                        <div class="flex justify-center w-full">
                            <div class="table w-full lg:w-3/4 text-sm lg:text-sm">
                                <div class="table-header-group font-bold uppercase">
                                    <div class="table-row">
                                        <div class="table-cell text-center">Lp.</div>
                                        <div class="table-cell text-center">Data</div>
                                        <div class="hidden sm:table-cell text-center">Przeglądarka</div>
                                        {{-- <div class="hidden sm:table-cell text-left">System</div> --}}
                                        <div class="table-cell text-center">Ip</div>
                                        {{-- <div class="table-cell text-left">Kraj</div> --}}
                                        {{-- <div class="table-cell text-center">Status</div> --}}
                                    </div>
                                </div>
                                <div class="table-row-group">
                                    @foreach ($activities as $activity)
                                        <div class="table-row">
                                            <div class="table-cell text-center">
                                                {{ $loop->iteration }}
                                            </div>
                                            <div class="table-cell text-center">
                                                {{ $activity
                                                    ->created_at
                                                    ->setTimezone($timezone)
                                                    ->format('d.m.Y - H:i:s') }}
                                                </div>
                                            <div class="hidden sm:table-cell text-center">
                                                {{ substr($activity->getExtraProperty('userAgent'),0,70)."[...]" }}</div>
                                            {{-- <div class="hidden sm:table-cell">Xxxxxxx XX</div> --}}
                                            <div class="table-cell text-center">
                                                {{ $activity->getExtraProperty('ips')['publicIp'] }}
                                            </div>
                                            {{-- <div class="table-cell">Xxxxxxxxx</div> --}}
                                            {{-- @if ($activity->description == 'success')
                                                <div class="table-cell font-bold text-center text-green-600 ">OK</div>
                                            @else
                                                <div class="table-cell font-bold text-center text-red-500 ">Błąd</div>
                                            @endif --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
        </div>
    </div>

    <x-slot name="scripts">
        <script type="text/javascript">
            themeSelector();
        </script>
    </x-slot>
@endsection