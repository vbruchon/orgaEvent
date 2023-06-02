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


        <a href="{{ route('userEvent.create') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">Ajouter un nouvel événement</a>

        <div class="events">
                    @if($events->isEmpty())
                    <div class="p-8 border-2 w-3/4 mb-6 mx-auto mt-16">
                        <p class="">Aucun événement trouvé.</p>
                    </div>
                    @else
                    @foreach($events as $event)
                    <div class="relative">
                        <div class="p-8 border-2 w-3/4 mt-16 mb-6 mx-auto">
                            <p class="p-8 font-semibold text-3xl">{{$event->name}}</p>
                            <div class="flex mb-5 ">
                                <img class="w-4 h-auto" src="{{ asset('image/school.png') }}" alt="L'image est là">
                                <p class="p-2 mr-12 text-lg">  {{$event->structure->name}}</p>

                                <img class="w-4 h-2/100" src="{{ asset('image/partners.png') }}" alt="L'image est là">
                                <p class="p-2 text-lg"> : {{$event->partners}}</p>
                            </div>
                            <div class="flex mb-5">
                                <img class="w-5/100 h-auto" src="{{ asset('image/description.png') }}" alt="L'image est là">
                                <p class="p-2 text-lg">{{$event->description}}</p>
                            </div>
                            <div class="flex mb-5">
                                <img src="{{ asset('image/status.png') }}" alt="L'image est là" class="w-4 h-auto">
                                <p class="p-2 text-lg">  {{$event->status->name}}</p>
                            </div>
                            <div class="flex mb-5">
                                <img src="{{ asset('image/participants.png') }}" alt="L'image est là" class="w-4 h-auto">
                                <p class="p-2 text-lg"> {{$event->number_of_participants->name}}</p>
                            </div>
                            <div class="flex mb-5">
                                <img src="{{ asset('image/date.png') }}" alt="L'image est là" class="w-4 h-auto">
                                
                                <p class="p-2 text-lg"> {{$event->date_start}}</p>
                                @if($event->date_end !== $event->date_start)
                                <p class="p-2 text-lg"> {{$event->date_end}}</p>
                                @endif
                                <p class="p-2 text-lg">{{$event->hours}}</p>
                            </div>
                            <p class="italic">{{$event->organizer_needs}}</p>
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
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
        <script>
            let sucessMessage = document.getElementById('success-message');

            setTimeout(() => {
                sucessMessage.classList.add('hidden');
            }, 5000);
        </script>
    </main>
</x-app-layout>