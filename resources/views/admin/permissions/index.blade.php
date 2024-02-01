@extends('layouts.app')

@section('header')
  <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
    <x-admin-home-link />
      
    <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
      Zarządzanie uprawnieniami
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
              Wykaz uprawnień: 
            </div>
            <div class="flex flex-row py-2">
              @if (auth()->user()->can('create permissions'))
                <a href="{{ route('admin.permissions.create') }}">
                  <x-button>
                    Dodaj nowe
                  </x-button>
                </a>
              @endif
            </div>
          </div>
        </div>
        <div class="items-center px-4 pb-4 sm:px-6"> 

          @foreach ($permissions as $permission)
            <a href="{{ route('admin.permissions.show', Crypt::encryptString($permission->id)) }}">
              <div class="flex flex-row w-full items-center py-1 hover:bg-light-bg-primary/70 hover:dark:bg-dark-bg-primary/70 rounded-md ">
                <div class="ps-2 pe-4">{{ $loop->index + 1 }}.</div>
                <div class="grow">
                  <div class="sm:flex sm:flex-row">
                    <div>{{ $permission->name }}</div>
                    <div class="opacity-50">[id: {{ $permission->id }}, guard: {{ $permission->guard_name }}]</div>
                  </div>
                </div>
              </div>
            </a>
          @endforeach

        </div>
      </div>
    </div>
  </div>
@endsection