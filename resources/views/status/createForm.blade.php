<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un status') }}
        </h2>
    </x-slot>
    <x-create-form route="admin.status.store" label="Nom du status :"/>
</x-app-layout>