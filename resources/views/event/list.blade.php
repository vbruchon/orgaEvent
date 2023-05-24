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
            <a href="{{ route('event.create') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">Ajouter un nouvel événement</a>
            <a href="{{ route('event.my') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">User Contribution</a>
        </div>


        <div class="events">

            @foreach($events as $event)
            <div class="p-8 border-2 w-1/2 mb-6 mx-auto">
                <p class="p-8 font-semibold">{{$event->name}}</p>

                <p class="p-2 ">Structure : {{$event->structure->name}}</p>
                <p class="p-2 ">Parenaires : {{$event->partners}}</p>
                <p class="p-2 ">{{$event->description}}</p>
                <p class="p-2 ">Status : {{$event->status->name}}</p>
                <p class="p-2 ">Nbre participants : {{$event->number_of_participants->name}}</p>




                <div class="flex">
                    @if($event->date_start === $event->date_end)
                    <p class="p-2">{{$dateStartToDays[$event->id]}}</p>
                    @else
                    <p class="p-2">{{$dateStartToDays[$event->id]}}</p>
                    <p class="p-2">{{$dateEndToDays[$event->id]}}</p>
                    @endif
                    <p class="p-2 ">{{$event->hours}}</p>
                </div>
                <p class="italic">{{$event->organizer_needs}}</p>
            </div>


            @if(isset($dateStartToString[$event->id]))
            <p class="p-2">{{$dateStartToString[$event->id]}}</p>
            @endif
        </div>
        @endforeach
        <script>
            let sucessMessage = document.getElementById('success-message');

            setTimeout(() => {
                sucessMessage.classList.add('hidden');
            }, 5000);
        </script>
    </main>
</x-app-layout>