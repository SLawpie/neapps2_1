@props(['activities', 'timezone'])

<div {{ $attributes->merge(['class' => "bg-light-bg-secondary dark:bg-dark-bg-secondary 
    text-light-text-primary dark:text-dark-text-primary 
    shadow-sm sm:rounded-lg
    "]) }}>
    <div class="sm:flex items-center px-4 py-4 sm:px-6">
        <div class="w-full">
            <div class="text-xl font-bold pb-6">
                Ostatnie logowania:
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
                            <th class="hidden sm:table-cell text-center">Przeglądarka / System</th>
                            {{-- <div class="hidden sm:table-cell text-left">System</div> --}}
                            <th class="table-cell text-center">Ip</th>
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
                            <tr class="border-t border-dark-text-secondary dark:border-light-text-secondary ">
                                <td class="table-cell text-center">{{ $loop->iteration }}</td>
                                <td class="table-cell text-center text-sm py-2">
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
                                <td class="hidden sm:table-cell text-center">
                                    <p>{{ $activity->getExtraProperty('userAgent') }}</p>
                                    {{-- <p>{{ substr($activity->getExtraProperty('userAgent'),0,120)."[...]" }} </p> --}}
                                </td>
                                {{-- <div class="hidden sm:table-cell">Xxxxxxx XX</div> --}}
                                <td class="table-cell text-center">
                                    {{ $activity->getExtraProperty('ips')['publicIp'] }}
                                </td>
                                {{-- <div class="hidden sm:table-cell">Xxxxxx</div> --}}
                                @if ($activity->description == 'success')
                                    <td class="table-cell font-bold text-center text-green-600 ">OK</td>
                                @elseif ($activity->description == 'logout')
                                    <td class="table-cell font-bold text-center text-blue-500 px-2">Logout</td>
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