@extends('layouts.app')

@section('header')
    <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
        <x-admin-home-link />
        <x-path-link :href="route('admin.roles.index')">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('layouts.partials.massages')

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
                    text-light-text-primary dark:text-dark-text-primary 
                    shadow-sm sm:rounded-lg
                    ">
                <div class="sm:flex px-4 pt-6 sm:px-6"> 
                    <div class="sm:flex flex-row items-center justify-between w-full">
                        <div class="text-xl pb-4">
                            <span class="font-bold">Rola: </span>
                            <span class="font-mono ps-2">{{ $role->name }}</span>
                            <div class="text-base opacity-50">guard: {{ $role->guard_name }}</div>
                            <div class="text-base opacity-50">ID: {{ $role->id }}</div>
                        </div>
                        <div class="flex flex-row">
                            
                            @if ((auth()->user()->can('edit roles')))
                              <a href="{{ route('admin.roles.edit', Crypt::encryptString($role->id)) }}">
                                <x-button>
                                  Edytuj
                                </x-button>
                              </a>
                            @else
                              <x-button-disabled>
                                Edytuj
                              </x-button>
                            @endif
                            
                            @if ((auth()->user()->can('delete roles')))
                              <div class="px-2">
                                <a href="{{ route('admin.roles.delete', Crypt::encryptString($role->id)) }}">
                        
                                @if (count($users) <> 0) 
                                  <x-button-red-disabled>
                                    Usuń
                                  </x-button-red-disabled>
                                @else 
                                  <x-button-red>
                                    Usuń
                                  </x-button-red>
                                @endif

                                </a>
                              </div>
                            @else
                              <div class="px-2">
                                <x-button-red-disabled>
                                  Usuń
                                </x-button-red-disabled>
                              </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex flex-row px-4 py-4 sm:px-6">
                  <div class="pe-4 opacity-50"> 
                      przypisane do użytkowników:
                  </div>
                  <div>
                      @if (count($users) <> 0)
                          @foreach ($users as $user)
                              <div class="font-mono items-center">
                                  {{ $user->username }}
                                  @php
                                      $role = Spatie\Permission\Models\Role::with('users')->where('id', $user->id)->first();
                                  @endphp
                              </div>
                          @endforeach
                      @else
                          <div class="font-mono font-semibold text-red-500"> 
                              brak przypisanych użytkowników
                          </div>
                      @endif
      
                  </div>
              </div>

                <div class="flex flex-row px-4 py-4 sm:px-6">
                    <div class="pe-4 opacity-50"> 
                        posiada przypisane uprawnienia:
                    </div>
                    <div>
                        @if (count($permissions) <> 0)
                            @foreach ($permissions as $permission)
                                <div class="font-mono"> 
                                    {{ $permission->name }}
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
    </div>
@endsection