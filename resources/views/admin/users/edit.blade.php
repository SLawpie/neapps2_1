@extends('layouts.app')

@section('header')
  <div class="flex flex-row h-6 text-light-text-primary dark:text-dark-text-primary">
    <x-admin-home-link />
    <x-path-link :href="route('admin.users.index')">
      <x-icons.chevron-double-left />
    </x-path-link>
    <x-icons.dot class="-ms-1"/>
    
    <h2 class="bg-light-bg-secondary dark:bg-dark-bg-secondary font-semibold text-xl text-light-text-primary dark:text-dark-text-primary leading-tight">
      Zarządzanie użytkownikmi
    </h2>
  </div>
@endsection

@section('content')
  <div class="pt-8">
    <form method="POST" action="{{ route('admin.users.update', Crypt::encryptString($user->id)) }}">
      @csrf

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @include('layouts.partials.massages')

        <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary 
          text-light-text-primary dark:text-dark-text-primary 
          shadow-sm sm:rounded-lg
          ">
          <div class="sm:flex px-4 py-6 sm:px-6"> 
            <div class="sm:flex flex-row items-center justify-between w-full">
              <div class="text-xl">
                <span class="font-bold">Nazwa użytkownika: </span>
                <span class="font-mono ps-2">{{ $user->username }}</span>
                <div class="text-base opacity-50">ID: {{ $user->id }}</div>
              </div>
              <div class="flex flex-row">
                <x-button>
                  Zapisz
                </x-button>
              </div>
            </div>
          </div>

          <div class="flex w-full px-4 pb-4">
            <div class="">
              <div class="h-36 w-36 mx-auto">
                <x-icons.user class="fill-light-bg-primary dark:fill-dark-bg-primary"/>
              </div>
              <x-button disabled class="text-xs py-0 px-2 rounded-[4px]">Zmień</x-button>
              <x-button-red disabled class="text-xs py-0 px-2 rounded-[4px]">Usuń</x-button-red>
            </div>
            <div class="ps-8">
                <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                  <div class="pe-4 sm:min-w-40">
                    Imię:
                  </div>
                  <x-input 
                    required
                    id="new-firstname"
                    type="text" 
                    name="new-firstname" 
                    class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                    placeholder="podaj imię"
                    value="{{ $user->firstname }}"
                    autofocus
                  />
                </div>
                  <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                    <div class="pe-4 sm:min-w-40">
                      Nazwisko: 
                    </div>
                    <x-input 
                      id="new-lasttname"
                      type="text" 
                      name="new-lasttname" 
                      class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                      placeholder="podaj nazwisko"
                      value="{{ $user->lastname }}"
                    />
                  </div>
                  <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                    <div class="pe-4 sm:min-w-40">
                      e-mail:
                    </div>
                    <x-input
                      required
                      id="new-email"
                      type="email" 
                      name="new-email" 
                      class="h-10 placeholder:text-light-text-primary/30 dark:placeholder:text-dark-text-primary/30"
                      placeholder="podaj e-mail"
                      value="{{ $user->email }}"
                    />
                  </div>
                  <div class="sm:flex sm:text-lg px-4 pb-4 sm:px-6">
                    <div class="pe-4 sm:min-w-40">
                      Hasło:
                    </div>
                    <div class="pe-4 font-mono font-semibold">
                      <a href="{{ route('admin.users.change-password-form', Crypt::encryptString($user->id)) }}">
                        <x-button type="button">
                          zmiana hasła
                        </x-button>
                      </a>
                    </div>
                  </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="pe-4 text-xl font-semibold"> 
              Role:
            </div>
            <div class="ps-8">
              @foreach (Spatie\Permission\Models\Role::all() as $role)
                @if ((($role->name == 'admin') || ($role->name == 'super-admin')) && (!auth()->user()->hasRole('super-admin')))
                  @continue
                @endif
                  <div class="ps-4 font-mono flex items-center"> 
                    <input type="checkbox" name="{{ $role->id }}" value="r-{{ $role->id }}"
                    @php
                      echo ($user->hasRole($role->name)) ? "checked" : "";
                    @endphp
                    >
                    <p class="ps-2">{{ $role->name }}</p>
                  </div>
              @endforeach

            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="pe-4 text-xl font-semibold"> 
              Uprawnienia:
            </div>
            <div class="ps-8">
              @foreach (Spatie\Permission\Models\Permission::all() as $permission)
                <div class="ps-4 font-mono flex items-center"> 
                  <input type="checkbox" name="{{ $permission->id }}" value="p-{{ $permission->id }}"
                  @php
                    echo ($user->can($permission->name)) 
                      ? (!$user->hasDirectPermission($permission->name)) 
                        ? "checked disabled" 
                        : "checked"
                      : ""; 
                  @endphp
                  >
                  <p class="ps-2">{{ $permission->name }}</p>
                </div>
              @endforeach

            </div>
          </div>


        </div>
      </div>
    </form>
  </div>
@endsection