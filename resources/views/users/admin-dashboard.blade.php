@extends('layouts.app')

@section('header')
    <div class="flex flex-row text-xl 
        bg-light-bg-secondary dark:bg-dark-bg-secondary 
        text-light-text-primary dark:text-dark-text-primary
        ">
        <div class="font-semibold leading-tight">
            {{ Auth::user()->firstname }}. 
        </div>
        <div class="ps-2 font-medium">
            {{ __('dashboard.goodtoseeyou') }}
        </div>
    </div>
@endsection

@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-2">
                <x-modules.users-list class="col-span-3 row-span-2"/>

                <x-modules.last-activities class="col-span-9 row-span-1"/>
                
            </div>

            <div class="py-2"></div>
        </div>
    </div>
@endsection