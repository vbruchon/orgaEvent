<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un libellé pour le nombre de participants') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <form action="{{ route('numberOfParticipants.store') }}" method="post" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
            @csrf
            <label class="mb-3 text-xl" for="name">Nom du status :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', '') }}">

            <input type="submit" value="Envoyer">
        </form>
    </main>
</x-app-layout>
