<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Larablog') }}
        </h2>
        <p>Un blog codé avec Laravel 10</p>
    </x-slot>

    <x-slot name="slot">
        <x-hero />
    </x-slot>
</x-app-layout>