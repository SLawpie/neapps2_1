@if (($errors->any()) || ((session('messagetype'))))
<div id="" class="flex justify-center w-full">
    <div class="flex w-full sm:w-3/4 pb-6">
        
            @if (session('messagetype'))
                <x-flash-box type="{{ session('messagetype') }}">
                    <p class="font-medium">{{ session('message') }}</p>
                </x-flash-box>
            @endif
            @if ($errors->any())
                <x-flash-box type="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="font-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-flash-box>
            @endif
       
    </div> 
</div>
@endif