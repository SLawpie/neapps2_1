@props(['type' => 'alert'])

<div class="w-full border-t-4 rounded-b 
    {{ $type == 'success' ? 'bg-teal-100 border-teal-500 text-teal-900' : '' }} 
    {{ $type == 'alert' ? 'bg-red-100 border-red-500 text-red-900' : '' }} 
    {{ $type == 'info' ? 'bg-blue-100 border-blue-500 text-blue-900' : '' }} 
    px-4 py-3 shadow-md" role="alert">
    <div class="flex items-center">
        <div class="py-1">
            <svg class="fill-current h-8 w-8 mr-4" 
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 20 20"
                fill-rule="evenodd"
                clip-rule="evenodd" >
                
                @switch($type)
                    @case('alert')
                        <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"/>
                        @break
                    @case('info')
                        <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"/>
                        @break
                    @default
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                @endswitch
                
            </svg>
        </div>
        <div>
            {{ $slot }}
        </div>
    </div>
</div>