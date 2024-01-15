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
            {{-- <div class="justify-center"> --}}
                {{-- <div class="table w-96 text-xs"> --}}
                <table class="w-full">
                    {{-- <div class="table-header-group font-bold uppercase"> --}}
                    <thead>
                        {{-- <div class="table-row"> --}}
                        <tr>
                            <th class="table-cell text-center">Lp.</th>
                            <th class="table-cell text-center">Data</th>
                            <th class="table-cell text-center">Nazwa</th>
                            <th class="hidden sm:table-cell text-center w-1/2">Przeglądarka / System</th>
                            {{-- <div class="hidden sm:table-cell text-left">System</div> --}}
                            <th class="table-cell text-center">Ip</div>
                            {{-- <div class="hidden sm:table-cell text-left">Kraj</div> --}}
                            <th class="table-cell text-center">Status</th>
                        </tr>
                        {{-- </div> --}}
                    </thead>
                    {{-- </div> --}}
                    {{-- <div class="table-row-group"> --}}
                    <tbody class="">
                        @foreach ($activities as $activity)
                            {{-- <div class="table-row"> --}}
                            <tr class="hover:bg-light-bg-primary/50 dark:hover:bg-dark-bg-primary/50 cursor-default">
                                <td class="table-cell text-center">{{ $loop->iteration }}</td>
                                <td class="table-cell text-center text-sm">
                                    <div>
                                        {{ $activity
                                            ->created_at
                                            ->setTimezone($timezone)
                                            ->format('d.m.Y') }}
                                    </div>
                                    <div class="text-light-text-secondary dark:text-dark-text-secondary">
                                        {{ $activity
                                            ->created_at
                                            ->setTimezone($timezone)
                                            ->format('H:i:s') }}
                                    </div>
                                </td>
                                <td class="table-cell text-center">
                                @if ($activity->causer_id)
                                    {{ App\Models\User::where('id', $activity->causer_id)->first()->username }}     
                                @else
                                    <p class="text-red-500 font-semibold">{{ $activity->getExtraProperty('username')}}</p>
                                @endif
                                </td>
                                <td class="hidden sm:table-cell text-center text-sm">
                                    <p class="text-clip overflow-hidden">{{ $activity->getExtraProperty('userAgent') }}</p>
                                    {{-- <p>{{ substr($activity->getExtraProperty('userAgent'),0,70)."[...]" }} </p> --}}
                                </td>
                                {{-- <div class="hidden sm:table-cell">Xxxxxxx XX</div> --}}
                                <td class="table-cell text-center">
                                    <div>
                                        {{ $activity->getExtraProperty('ips')['publicIp'] }}
                                    </div>
                                    <div class="text-sm text-light-text-secondary dark:text-dark-text-secondary">
                                        {{ $activity->getExtraProperty('ips')['clientIp'] }}
                                    </div>
                                </td>
                                {{-- <div class="hidden sm:table-cell">Xxxxxx</div> --}}
                                @if ($activity->description == 'success')
                                    <td class="table-cell font-bold text-center text-green-600 ">OK</td>
                                @elseif ($activity->description == 'logout')
                                    <td class="table-cell font-bold text-center text-blue-500 ">Logout</td>
                                @else
                                    <td class="table-cell font-bold text-center text-red-500 ">Błąd</td>
                                @endif
                            </tr>
                            {{-- </div> --}}
                        @endforeach
                    </tbody>
                    {{-- </div> --}}
                </table>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>