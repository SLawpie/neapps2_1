@extends('layouts.app')

@section('header')
    <x-admin-header />
@endsection

@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-y-4 sm:gap-x-4">
                <x-modules.last-activities :activities="$activities" :timezone="$timezone" class="col-span-12 row-span-1"/>

                <x-modules.users-list :users="$users" class="col-span-6 lg:col-span-4 row-span-2"/>
                <x-modules.roles-permissions class="col-span-6 lg:col-span-3 row-span-1 
                    border-l sm:border-0 border-light-accent dark:border-dark-accent"/>
            </div>

            <div class="py-2"></div>
        </div>
    </div>
@endsection