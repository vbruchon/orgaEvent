<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des structures') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <h2 class="text-xl mb-6">Liste des Structures</h2>

        @if($structures->count() > 0)
        <ul>
            @foreach($structures as $structure)
            <li>{{ $structure->name }}</li>
            @endforeach
        </ul>
        @else
        <p>Aucune Structure</p>
        @endif

        <a href="{{ route('add.structure') }}" class="mb-3 text-xl">Ajouter une nouvelle structure</a>
    </main>
</x-app-layout>