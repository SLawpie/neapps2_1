@extends('layouts.app')


@section('header')
    <div class="flex flex-row text-xl font-semibold 
    bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary
    ">
        {{ __('medical-reports.name') }}
    </div>
@endsection


@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 order-b border-dark-bg">
                    <div class="text-xl font-bold">
                        {{ $sheetName }}
                    </div>
                    <div>
                        Wykaz przeprowadzonych badań.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">

                @foreach ($examsTypes as $i => $examType)
                    <div class="" onclick="pleaseWait({{ $i }})">
                        @php
                            $values = [$i, $path, $file, $sheetName, $examType];
                            $string = implode(';', $values);          
                        @endphp
                    
                        <x-app-card active :href="route('medical-reports.show-report', Crypt::encryptString($string))">
                            <x-slot name="image">
                                <x-icons.exam-file class="stroke-0 fill-light-bg-primary dark:fill-dark-bg-primary"/>
                            </x-slot>
                            <div id="please-wait-text-{{ $i }}" class="text-sm sm:text-lg">
                                {{ $examType }}
                            </div>
                            <div id="please-wait-{{ $i }}" class="hidden">
                                <x-icons.wait class="text-light-text-primary dark:text-dark-text-primary"/>
                            </div>
                        </x-app-card>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-secondary dark:text-dark-text-secondary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end py-2 px-6 text-sm opacity-50">
                    plik: {{ $file }}
                </div>
            </div>
        </div>
    </div>
@endsection