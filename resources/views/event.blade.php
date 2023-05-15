<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>
    <main class="w-full mt-10">
        <a href="{{ route('add.event') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900 ">Ajouter un nouvel événement</a>

        <br>
        <br>
        <br>

        <div class="table w-full p-2 mt-8 w-fit">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                ID
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Structure Organisatrice
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Partenaires Organisateurs
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Intitulé
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Description de l'événement
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Status
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Nombre de participants
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Du
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Au
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Date prévisionnel de début
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Date prévisionnel de fin
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                De
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                À
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Besoins de l'organisateur
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-l font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Action
                            </div>
                        </th>
                    </tr>
                </thead>
                @foreach($events as $event)

                <tbody>
                    <tr class="bg-gray-50 text-center">
                        <td class="p-2 border-r">
                    </tr>
                    <tr class="bg-gray-100 text-center border-b text-l text-gray-600">
                        <td class="p-2 border-r">{{$event->id}}</td>
                        <td class="p-2 border-r">{{$event->structures_id}}</td>
                        <td class="p-2 border-r">{{$event->partners_id}}</td>
                        <td class="p-2 border-r">{{$event->name}}</td>
                        <td class="p-2 border-r">{{$event->description}}</td>
                        <td class="p-2 border-r">{{$event->status}}</td>
                        <td class="p-2 border-r">{{$event->number_of_participants}}</td>
                        <td class="p-2 border-r">{{$event->date_start}}</td>
                        <td class="p-2 border-r">{{$event->date_end}}</td>
                        <td class="p-2 border-r">{{$event->expected_date_start}}</td>
                        <td class="p-2 border-r">{{$event->expected_date_end}}</td>
                        <td class="p-2 border-r">{{$event->hours_start}}</td>
                        <td class="p-2 border-r">{{$event->hours_end}}</td>
                        <td class="p-2 border-r">{{$event->organizer_needs}}</td>
                        <td class="p-2 border-r">
                            <div class="flex flex-nowrap space-x-1 ">
                                <a href="" class="bg-orange-500 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold  ">
                                    Modifier
                                </a>

                                <form method="post" action="">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach

            </table>
        </div>

    </main>
</x-app-layout>