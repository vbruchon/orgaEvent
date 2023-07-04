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
                    <h2 class="text-xl mb-6">Bienvenue sur votre tableau de bord Archimède !</h2>
                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                        <x-custom-button route="userEvent.all" content="Consulter les événements" />
                        <x-custom-button route="userEvent.create" content="Ajouter un événement" />
                        <x-custom-button route="userEvent.my" content="Voir mes événements" />
                    </div>


                    <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                        <div class="flex items-center p-8 bg-white shadow-lg shadow-gray-350 rounded-lg">
                            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                {!! $svg['event'] !!}
                            </div>
                            <div>
                                <span class="block text-gray-500">Événements créés</span>
                                <span class="block text-2xl font-bold">{{ $countEvents}}</span>
                            </div>
                        </div>
                        @if($isAdmin)
                        <div class="flex items-center p-8 bg-white shadow-lg shadow-gray-350 rounded-lg">
                            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                {!! $svg['user'] !!}

                            </div>
                            <div>
                                <span class="block text-gray-500">Utilisateurs</span>
                                <span class="block text-2xl font-bold">{{$countUsers}}</span>
                            </div>
                        </div>
                        <div class="flex items-center p-8 bg-white shadow-lg shadow-gray-350 rounded-lg">
                            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                {!! $svg['user'] !!}

                            </div>
                            <div>
                                <span class="block text-gray-500">Dernier utilisateur inscrit</span>
                                <span class="block text-xl font-bold">{{$latestUser->name}}</span>
                                <span class="block text-xl font-bold">{{$latestUser->email}}</span>
                            </div>
                        </div>
                        @endif
                    </section>

                    <section class="grid gap-6">
                        <div class="flex items-center p-8 bg-white shadow-lg shadow-gray-350 rounded-lg">
                            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                {!! $svg['event'] !!}
                            </div>
                            <div>
                                <span class="block text-2xl font-bold">Dernière contribution :</span>
                                @if($userEvent !== null)
                                <span class="block text-gray-500">{{ $userEvent->name }}</span>
                                @else
                                <span class="block text-gray-500">Aucun événement encore créés</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center p-8 bg-white shadow-lg shadow-gray-350 rounded-lg">
                            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                {!! $svg['event'] !!}
                            </div>
                            <div class="w-full">
                                <span class="block text-2xl font-bold">Prochains événements dans les 30 jours :</span>
                                <table class="w-full border mx-auto my-4">
                                    <thead>
                                        <tr class="bg-gray-50 border-b">
                                            <th class="p-2 border-r cursor-pointer text-m font-thin text-gray-500">
                                                <div class="flex items-center justify-center">
                                                    Nom de l'événement
                                                </div>
                                            </th>
                                            <th class="p-2 border-r cursor-pointer text-m font-thin text-gray-500">
                                                <div class="flex items-center justify-center">
                                                    Date de début
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($futureEvents as $event)
                                        <tr class="bg-gray-100 text-center border-b text-xl text-gray-600">
                                            <td class="p-2 border-r py-4">{{ $event->name }}</td>
                                            <td class="p-2 border-r py-4">{{ $event->date_start }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>