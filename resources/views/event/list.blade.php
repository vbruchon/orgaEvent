<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div id="success-message" class="bg-green-400 p-6 text-center rounded shadow animate-movedown">
        {{ session('success') }}
    </div>
    @endif
    <main class="w-full mt-10">

        <div class="mb-8">
            <a href="{{ route('userEvent.create') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">Ajouter un nouvel événement</a>
            <a href="{{ route('userEvent.my') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">User Contribution</a>
        </div>
        @if(isset($selectedStructure) || isset($selectedStatus) || isset($selectedParticipants))
        <x-filterbar :structures="$structures" :selectedStructure="isset($selectedStructure) ? $selectedStructure : ''" :status="$status" :selectedStatus="isset($selectedStatus) ? $selectedStatus : ''" :numberOfParticipants="$numberOfParticipants" :selectedParticipant="isset($selectedParticipant) ? $selectedParticipant : ''" :route="'userEvent.filter'" />
        @else
        <x-filterbar :structures="$structures" :status="$status" :numberOfParticipants="$numberOfParticipants" route="userEvent.filter" />
        @endif



        <div class="events">
            @if($events->isEmpty())
            <p>Aucun événement trouvé.</p>
            @else
            @foreach($events as $event)
            <div class="p-8 border-2 w-1/2 mb-6 mx-auto">
                <p class="p-8 font-semibold text-3xl">{{$event->name}}</p>
                <div class="flex mb-5 ">
                    <img class="w-1/20" src="{{ asset('image/school.png') }}" alt="L'image est là">
                    <p class="p-2 mr-12 text-lg"> : {{$event->structure->name}}</p>

                    <img class="w-1/20" src="{{ asset('image/partners.png') }}" alt="L'image est là">
                    <p class="p-2 text-lg"> : {{$event->partners}}</p>
                </div>
                <div class="flex mb-5">
                    <img class="w-1/20" src="{{ asset('image/description.png') }}" alt="L'image est là">
                    <p class="p-2 text-lg">{{$event->description}}</p>
                </div>
                <div class="flex mb-5">
                    <img src="{{ asset('image/status.png') }}" alt="L'image est là" class="w-1/20">
                    <p class="p-2 text-lg"> : {{$event->status->name}}</p>
                </div>
                <div class="flex mb-5">
                    <img src="{{ asset('image/participants.png') }}" alt="L'image est là" class="w-1/20">
                    <p class="p-2 text-lg"> : {{$event->number_of_participants->name}}</p>
                </div>
                <div class="flex mb-5">
                    <img src="{{ asset('image/date.png') }}" alt="L'image est là" class="w-1/20">
                    @if($event->date_start === $event->date_end)
                    <p class="p-2 text-lg"> : {{$dateStartToDays[$event->id]}}</p>
                    @else
                    <p class="p-2 text-lg"> : {{$dateStartToDays[$event->id]}}</p>
                    <p class="p-2 text-lg">{{$dateEndToDays[$event->id]}}</p>
                    @endif
                    <p class="p-2 text-lg">{{$event->hours}}</p>
                </div>
                <p class="italic">{{$event->organizer_needs}}</p>
                @if($isAdmin)
                <div class="flex flex-nowrap justify-end space-x-1 ">
                    <a href="{{ route('userEvent.edit', $event) }}" class="bg-fuchsia-700 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold  ">
                        Modifier
                    </a>
                    <form method="post" action="{{ route('userEvent.destroy', $event->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="bg-red-500 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold">
                            Supprimer
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @if(isset($dateStartToString[$event->id]))
            <p class="p-2">{{$dateStartToString[$event->id]}}</p>
            @endif
            @endforeach
            @endif
        </div>
        <script>
            let sucessMessage = document.getElementById('success-message');

            setTimeout(() => {
                sucessMessage.classList.add('hidden');
            }, 5000);
        </script>
    </main>
</x-app-layout>