@extends('layouts.app')


@section('header')
    @include('medical-reports.partials.navigation')
@endsection



@section('content')
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 order-b border-dark-bg">
                    Wykaz przeprowadzonych badań dla konkretnego lekarza.
                </div>
            </div>
        </div>
    </div>
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- @include('layouts.partials.massages') --}}

            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primarydark:text-dark-text-primary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 order-b border-gray-200">
                    <form action="{{ route('medical-reports.import-file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                
                        <div class="">
                            <div class="col-lg-6 col-xl-5">
                                <div class="custom-file flex flex-row">
                                    <div class="wait relative basis-full md:basis-1/3">
                                        <div class="">
                                            <label for="file-upload" class="custom-file-upload">
                                                <input id="file-upload" type="file" name="file" class="hidden" />
                                                <div id="file-upload-choose" class="w-full px-4 py-2 flex justify-center bg-light-accent dark:bg-dark-accent border border-transparent rounded-md font-semibold text-xs text-dark-text-primary uppercase tracking-widest hover:ring hover:bg-opacity-80 dark:hover:bg-opacity-80 active:bg-light-accent dark:active:bg-dark-accent focus:outline-none focus:border-light-accent dark:focus:border-dark-accent focus:ring ring-light-accent dark:ring-dark-accent disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                                                    wybierz plik
                                                </div>
                                            </label>
                                            <div class="pt-2">
                                                <div class="flex justify-center font-bold">
                                                    <div id="file-upload-title" class="hidden text-light-text-primary dark:text-dark-text-primary">
                                                        nazwa pliku z badaniami
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="file-upload-send" class="pt-6 hidden" onclick="pleaseWait(0)">
                                                <x-button type="submit" name="submit" class="w-full ">
                                                    <div id="please-wait-text-0" class="w-full flex justify-center items-center text-dark-text-primary">
                                                        wczytaj plik
                                                    </div>
                                                    <div id="please-wait-0" class="hidden w-full ">
                                                        <div class="flex justify-center items-center">
                                                            <x-icons.wait class="text-dark-text-primary"/>
                                                            <div class="ml-3">
                                                                proszę czekać...
                                                            </div>
                                                        </div>
                                                   </div>
                                                </x-button>
                                            </div>
                                        </div>
                                    </div>
                                 </div>  
                            </div>
                        </div>
                    </form>

                    <script type="application/javascript">

                        $('input[type="file"]').change(function(e){
                            var fileName = e.target.files[0].name;
                            $('#file-upload-choose').html('ponów wybór pliku');
                            $('#file-upload-title').html(fileName);
                            $('#file-upload-title').toggleClass('hidden', false);
                            $('#file-upload-send').toggleClass('hidden', false);
                       });

                    </script>

                </div>
            </div>
            <div class="pt-4">
                @include('layouts.partials.massages')
            </div>

        </div>
    </div>
@endsection

