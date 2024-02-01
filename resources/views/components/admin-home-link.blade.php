@role('visitor')
    <x-path-link :href="route('visitor.admin-panel')">
        <x-icons.home />
    </x-path-link>
@else
    <x-path-link :href="route('admin.admin-panel')">
        <x-icons.home />
    </x-path-link>
@endrole
    <x-icons.dot />