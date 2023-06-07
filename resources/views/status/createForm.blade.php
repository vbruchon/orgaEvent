<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un status') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <form action="{{ route('admin.structure.store') }}" method="post" class="bg-gray-100 block p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
            <section class="relative border-2 border-custom-light-purple rounded-lg p-14 mb-8 ">
                <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Informations générales</h2>
                @csrf
                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl" for="name">Nom du status :</label>
                    @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
                    <input class="mb-6 h-8 border-2 border-black @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', '') }}">
                </div>
            </section>
            <input class="w-1/5 mb-3 cursor-pointer block mx-auto text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105" type="submit" value="Envoyer">
        </form>
    </main>
</x-app-layout>