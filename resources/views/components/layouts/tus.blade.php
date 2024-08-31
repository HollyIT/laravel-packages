<x-layouts.app title="TUS">
    <x-slot:navigation>
        <x-nav-link :href="route('tus.basic')" :active="request()->routeIs('tus.basic')">
            {{ __('Basic') }}
        </x-nav-link>
        <x-nav-link :href="route('tus.livewire')" :active="request()->routeIs('tus.livewire')">
            {{ __('Livewire') }}
        </x-nav-link>
    </x-slot:navigation>
    {{ $slot }}
    @push('scripts')

    @endpush
</x-layouts.app>
