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
                    @auth
                    <h1 class="text-2xl mb-6">Bonjour {{ Auth::user()->name }},</h1>
                    @endauth
                    <h2 class="text-xl mb-6">Bienvenue sur votre tableau de bord</h2>
                    <p class="text-lg mb-3">Que souhaitez-vous faire ?</p>
                    <div class="flex justify-center flex-wrap">
                        <a href="" class="w-80 ml-5 mb-3 text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105">Consulter les événements</a>
                        <a href="" class="w-80 ml-5 mb-3 text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105">Ajouter un événement</a>
                        <a href="" class="w-80 ml-5 mb-3 text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105">Consulter les structure</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


