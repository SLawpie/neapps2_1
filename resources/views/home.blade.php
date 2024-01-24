@extends('layouts.app')

@section('header')
  <x-admin-header />  
@endsection

@section('content')
  <div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        <x-app-card active :href="route('medical-reports.index')">
          <x-slot name="image">
            <img src="{{ asset('images/raporty.icon.png') }}" alt="Medical Reports Icon">
          </x-slot>
          {{ __('medical-reports.name') }}
        </x-app-card>
        <div class="">
          <x-app-card active :href="route('dedusting.filtration-area')">
            Pow. filtracyjna
          </x-app-card>
        </div>
        <div class="invisible sm:visible">
          <x-app-card />
        </div>
        <div class="invisible lg:visible">
          <x-app-card />
        </div>
      </div>
    </div>
  </div>
@endsection
