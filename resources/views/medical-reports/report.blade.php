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
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="sm:flex items-center p-6 order-b border-dark-bg">
                    <div class="sm:flex-none">
                        <div class="text-xl font-bold">
                            {{ $sheetName }}
                        </div>
                        <div>
                            Wykaz przeprowadzonych <b>{{ $sumOfExams }}</b> badań <b>{{ $examType }}</b>.
                        </div>
                        <div>
                            @php
                                $formatedText = new NumberFormatter('de-DE', NumberFormatter::DECIMAL);
                                $text = $formatedText->format($amount);
                            @endphp
                            Wartość przeprowadzonych badań: <b>{{ $text }}zł</b>.
                        </div>
                        <div id="error-message" class="hidden pt-4 text-red-600 text-xl font-bold">
                            Niektórych badań brakuje w cenniku!
                        </div>
                    </div>
                    <div class="sm:grow"></div>
                    <div class="report-area sm:flex-none pt-4 sm:pt-0 sm:px-6 justify-center cursor-pointer" onClick="switchToText()">
                        <x-button class="w-48 justify-center">
                            wersja do maila
                        </x-button>
                    </div>
                    <div class="text-area hidden pt-4 sm:pt-0 sm:flex-none sm:px-6 justify-center cursor-pointer" onClick="switchToHtml()">
                        <x-button class="w-48 justify-center">
                            powrót
                        </x-button>
                    </div>
              </div>
            </div> 
        </div>
    </div>


    
    <div class="report-area pt-1">
        @foreach ($exams as $i => $exam)
            <div class="pt-1">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primary dark:text-dark-text-primary overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="ps-2 pe-6 py-2 order-b border-dark-bg">
                            <div class="flex">
                                <div class="flex basis-10 justify-center">
                                    {{ $exam['sumOfExam'] }}
                                </div>
                                <div class="w-full">

                                    @php
                                        $formatedText = new NumberFormatter('de-DE', NumberFormatter::DECIMAL);
                                        $text = $formatedText->format($exam['amount']);
                                    @endphp
                                    
                                    <div class="exam-type flex flex-inline font-bold 
                                        @php 
                                            echo (($text == 0) ? " text-red-600" : "");
                                            echo "\">";
                                            if ($text == 0) {
                                                echo ("
                                                    <script>
                                                        $('#error-message').toggleClass('hidden', false);
                                                    </script>
                                                ");
                                            } else {
                                                
                                            }
                                        @endphp
                                    
                                        <div>{{ $exam['name'] }}</div>
                                        <div class="pl-2">= {{ $text }}zł</div>
                                        
                                    </div>

                                    @php
                                        $payers = $exam['payer'];
                                    
                                        uasort($payers, function($a, $b) {
                                            $at = iconv('UTF-8', 'ASCII//TRANSLIT', $a['name']);
                                            $bt = iconv('UTF-8', 'ASCII//TRANSLIT', $b['name']);
                                            return strcmp($at, $bt);
                                        });
                                    @endphp

                                    @foreach ($payers as $j => $payer)
                                        <div class="flex">
                                            <div class="flex text-light-text-secondary dark:text-dark-text-secondary basis-10 justify-center">
                                                {{ $payer['sum'] }}
                                            </div>
                                            <div>
                                                {{ $payer['name'] }}
                                            </div>
                                            <div class="flex pl-2 text-light-text-secondary dark:text-dark-text-secondary">
                                                @php
                                                    $formatedText = new NumberFormatter('de-DE', NumberFormatter::DECIMAL);
                                                    $text = $formatedText->format($payer['amount']);
                                                @endphp
                                               x {{ $payer['price'] }}zł = {{ $text }}zł
                                               
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-area pt-1 hidden">
        <div class="pt-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-primarydark:text-dark-text-primary overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex text-xl font-bold justify-center dark:text-light-text-primary bg-red-300 dark:bg-red-500 ps-2 pe-6 py-2 order-b border-gray-200 select-all cursor-pointer">

                        Kliknij poniżej i skopiuj do maila

                    </div>
                    <div id="myInput" class="font-mono ps-2 pe-6 py-2 order-b border-dark-bg select-all cursor-pointer bg-white text-black">
                        {{ $sheetName }}<br>

                        Wykaz przeprowadzonych {{ $sumOfExams }} badań {{ $examType }}.<br>

                        @php
                            $formatedText = new NumberFormatter('de-DE', NumberFormatter::DECIMAL);
                            $text = $formatedText->format($amount);
                        @endphp

                        Wartość przeprowadzonych badań: {{ $text }}zł.<br><br>
                        
                        @foreach ($exams as $i => $exam)
                            @php
                                $formatedText = new NumberFormatter('de-DE', NumberFormatter::DECIMAL);
                                $text = $formatedText->format($exam['amount']);
                            @endphp

                            {{ $exam['sumOfExam'] }}x {{ $exam['name'] }} = {{ $text }}zł<br>
                            
                            @php
                                $payers = $exam['payer'];
                            
                                uasort($payers, function($a, $b) {
                                    $at = iconv('UTF-8', 'ASCII//TRANSLIT', $a['name']);
                                    $bt = iconv('UTF-8', 'ASCII//TRANSLIT', $b['name']);
                                    return strcmp($at, $bt);
                                });
                            @endphp
                            @foreach ($payers as $j => $payer)
                                @php
                                    echo(str_repeat('&nbsp;',5));
                                    $formatedText = new NumberFormatter('de-DE', NumberFormatter::DECIMAL);
                                    $text = $formatedText->format($payer['amount']);
                                @endphp
                               
                                {{ $payer['sum'] }}x {{ $payer['name'] }}  x {{ $payer['price'] }}zł = {{ $text }}zł<br>

                            @endforeach
                            <br>
                        @endforeach
                        <br>
                        Kędzierzyn-Koźle,
                        @php
                            echo(date('d.m.Y').'r.')
                        @endphp
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="report-area pt-8 pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-light-bg-secondary dark:bg-dark-bg-secondary text-light-text-secondary dark:text-dark-text-secondaryoverflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end py-2 px-6 text-sm opacity-50">
                    plik: {{ $file }}
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">

        function switchToText() {
            var elra = document.getElementsByClassName("report-area");
            var elta = document.getElementsByClassName("text-area");
            Array.prototype.forEach.call(elra, function(el) {
                el.classList.add("hidden");
            });
            Array.prototype.forEach.call(elta, function(el) {
                el.classList.remove("hidden");
            });
        }
        function switchToHtml() {
            var elra = document.getElementsByClassName("report-area");
            var elta = document.getElementsByClassName("text-area");
            Array.prototype.forEach.call(elra, function(el) {
                el.classList.remove("hidden");
            });
            Array.prototype.forEach.call(elta, function(el) {
                el.classList.add("hidden");
            });
        }

    </script>
@endsection
