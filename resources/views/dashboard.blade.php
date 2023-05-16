<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl mb-6">Bienvenue sur votre tableau de bord</h2>
                    <p>Ici, vous pouvez :</p>
                    <div class="flex flex-col">
                        <a href="{{ route('event.list') }}" class="w-80 ml-5 mb-3 text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900">Consulter les événements</a>
                        <a href="{{ route('add.event') }}" class="w-80 ml-5 mb-3 text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900">Ajouter un événement</a>
                        <a href="{{ route('structure') }}" class="w-80 ml-5 mb-3 text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900">Consulter les structure</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>