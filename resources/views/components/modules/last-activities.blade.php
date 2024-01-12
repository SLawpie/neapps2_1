@props(['activities', 'timezone'])

<div {{ $attributes->merge(['class' => "bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary 
    shadow-sm sm:rounded-lg
    "]) }}>
    <div class="sm:flex items-center px-2 py-4 sm:px-4">
        <div class="w-full">
            <div class="text-base font-bold pb-4">
                Ostatnie aktywności:
            </div>
            <div class="flex justify-center w-full">
                <div class="table w-full text-xs">
                    <div class="table-header-group font-bold uppercase">
                        <div class="table-row">
                            <div class="table-cell text-center">Lp.</div>
                            <div class="table-cell text-center">Data</div>
                            <div class="table-cell text-center">Nazwa</div>
                            <div class="hidden sm:table-cell text-center">Przeglądarka / System</div>
                            {{-- <div class="hidden sm:table-cell text-left">System</div> --}}
                            <div class="table-cell text-center">Ip</div>
                            {{-- <div class="hidden sm:table-cell text-left">Kraj</div> --}}
                            <div class="table-cell text-center">Status</div>
                        </div>
                    </div>
                    <div class="table-row-group">
                        @foreach ($activities as $activity)
                            <div class="table-row">
                                <div class="table-cell text-center">{{ $loop->iteration }}</div>
                                <div class="table-cell text-center">
                                    {{ $activity
                                        ->created_at
                                        ->setTimezone($timezone)
                                        ->format('d.m.Y - H:i:s') }}
                                </div>
                                <div class="table-cell text-center">
                                @if ($activity->causer_id)
                                    {{ App\Models\User::where('id', $activity->causer_id)->first()->username }}     
                                @else
                                    {{ $activity->getExtraProperty('username')}}
                                @endif
                                </div>
                                <div class="hidden sm:table-cell text-center">
                                    {{ substr($activity->getExtraProperty('userAgent'),0,80)."[...]" }}
                                </div>
                                {{-- <div class="hidden sm:table-cell">Xxxxxxx XX</div> --}}
                                <div class="table-cell text-center">
                                    {{ $activity->getExtraProperty('ips')['publicIp'] }}
                                </div>
                                {{-- <div class="hidden sm:table-cell">Xxxxxx</div> --}}
                                @if ($activity->description == 'success')
                                    <div class="table-cell font-bold text-center text-green-600 ">OK</div>
                                @else
                                    <div class="table-cell font-bold text-center text-red-500 ">Błąd</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>