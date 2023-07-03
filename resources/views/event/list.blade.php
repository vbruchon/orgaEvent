<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-4">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>
    @if (session('success'))
    var successMessage = '{{ session('success') }}';
    if (successMessage) {
    <div id="success-message" class="bg-green-400 p-6 text-center rounded shadow animate-movedown">
        {{ session('success') }}
    </div>
    }
    @endif
    @if (Request::path() === 'dashboard/events')
    <div class="mt-6 ml-4">
        <x-custom-button route="userEvent.my" content="Mes événements" />
        <x-custom-button route="userEvent.create" content="Ajouter un nouvel événement" />
    </div>
    <div class="w-full sticky z-50 top-20 opacity-100 mb-4 ml-4">
        @if(isset($selectedStructure) || isset($selectedParticipants))
        <x-filterbar :structures="$structures" :selectedStructure="isset($selectedStructure) ? $selectedStructure : ''" :numberOfParticipants="$numberOfParticipants" :selectedParticipant="isset($selectedParticipant) ? $selectedParticipant : ''" :route="'userEvent.filter'" />
        @else
        <x-filterbar :structures="$structures" :numberOfParticipants="$numberOfParticipants" route="userEvent.filter" />
        @endif
    </div>
    @else
    <div class="mt-6 ml-4">
        <x-custom-button route="userEvent.all" content="Retourner aux événements" />
    </div>
    @endif




    <section id="events" class="w-5/6 mx-auto">
        <div class="events">
            @if($events->isEmpty())
            <div class="p-8 border-2 w-3/4 mb-6 mx-auto">
                <p class="">Aucun événement trouvé.</p>
            </div>
            @else
            @foreach($events as $event)
            <div class="relative w-full">
                @if(isset($dateStartToString[$event->id]))
                @php
                $dateStart = $dateStartToString[$event->id];
                @endphp
                @endif
                @if($event->is_Fix === 0)
                <img src="{{asset('image/badge.png')}}" alt="" class="w-1/6 absolute top-8 right-10">
                @endif
                <div class="p-8 border-2 w-80 mt-16 mb-6 mx-auto">
                    <p class="p-8 font-semibold text-3xl text-custom-blue">{{$event->name}}</p>
                    <div class="flex mb-5 items-center">
                        @if ($event->structure->name)
                        <div class="flex mb-5 items-center">
                            {!! $svg['structure'] !!}
                            <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->structure->name }}</p>
                        </div>
                        @endif
                        @if ($event->partners)
                        <div class="flex mb-5 items-center">
                            {!! $svg['partners'] !!}
                            <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->partners }}</p>
                        </div>
                        @endif
                    </div>
                    @if ($event->description)
                    <div class="flex mb-5 items-center">
                        {!! $svg['description'] !!}
                        <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->description }}</p>
                    </div>
                    @endif

                    @if ($event->number_of_participants->name)
                    <div class="flex mb-5 items-center">
                        {!! $svg['participants'] !!}
                        <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->number_of_participants->name }}</p>
                    </div>
                    @endif

                    @if($event->date_start)
                    <div class="flex mb-5 items-center">
                        {!! $svg['date'] !!}
                        <p class="p-2 text-lg text-custom-blue font-semibold">{{ \Carbon\Carbon::parse($event->date_start)->translatedFormat('d F Y') }}</p>
                        @if($event->date_end !== $event->date_start)
                        <p class="p-2 text-lg text-custom-blue font-semibold">{{ \Carbon\Carbon::parse($event->date_end)->translatedFormat('d F Y') }}</p>
                        @endif
                        <p class="p-2 text-lg text-custom-blue font-semibold">{{ $event->hours }}</p>
                    </div>

                    @endif
                    @if($event->organizer_needs)
                    <div class="flex mb-5  items-center">
                        {!! $svg['needs'] !!}
                        <p class="italic text-custom-blue">{{$event->organizer_needs}}</p>
                    </div>
                    @endif
                    @if($isAdmin || $event->user_id == Auth::id())
                    <div class="flex flex-nowrap justify-end space-x-1 ">
                        <a href="{{ route('userEvent.edit', $event) }}" class="transition duration-300 transform hover:scale-110 bg-custom-blue p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold  ">
                            Modifier
                        </a>
                        <form id="deleteForm" method="post" action="{{ route('userEvent.destroy', $event->id) }}">
                            @csrf
                            @method('delete')
                            <button type="button" class="transition duration-300 transform hover:scale-110 bg-red-600 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold delete-button" data-target="#confirmDeleteModal">
                                Supprimer
                            </button>
                        </form>

                        <!-- Modal -->
                        <div id="confirmDeleteModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
                            <div class="bg-custom-purple rounded-lg w-1/2 p-4">
                                <div class="p-6">
                                    <h3 class="text-2xl text-white font-bold mb-6">Confirmation de suppression</h3>
                                    <p class="text-white text-lg mb-6">Êtes-vous sûr de vouloir supprimer l'événement : {{$event->name}} ?</p>
                                    <div class="flex justify-end">
                                        <button type="button" id="cancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-dismiss="modal">Annuler</button>
                                        <button type="button" id="confirmDeleteButton" class="bg-red-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Confirmer la suppression</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    @endif
                </div>

                @isset($dateStart)
                <p class="absolute top-0 left-0 p-2 text-custom-blue font-medium">{{ $dateStart }}</p>
                <hr class="absolute top-10 left-10 p-2 w-1/15 border-custom-blue">
                @endisset
                @endforeach
            </div>
            @endif
        </div>
    </section>
    <script>
        if (document.getElementById('sucess-message')) {
            let sucessMessage = document.getElementById('success-message');

            setTimeout(() => {
                sucessMessage.classList.add('hidden');
            }, 5000);
        }
    </script>
    <script src="{{ asset('js/deleteModal.js') }}"></script>
</x-app-layout>