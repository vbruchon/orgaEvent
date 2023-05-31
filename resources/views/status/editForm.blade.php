<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le status') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <x-form-edit route="admin.status.update" :model="$status" />
    </main>
</x-app-layout>