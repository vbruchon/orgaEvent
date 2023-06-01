<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Modifier l'événement") }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="bg-green-400 p-6 text-center m-6 rounded shadow border border-green-800 animate-ping">
        {{ session('success') }}
    </div>
    @endif
    <div class="mb-8"></div>
    
    <a href="{{route('userEvent.all')}}" class="bg-amber-500 rounded-full pt-2 pb-2 pr-3 pl-3 ml-16 mt-16 font-semibold ">
        Retourner à l'Accueil
    </a>

    @if ($errors->any())
            <div class="bg-red-400 p-6 text-center m-6 rounded shadow border border-red-800 animate-ping">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form method="post" action="{{route('userEvent.update', $event)}}" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
    @csrf
    @method('put')
            <label class="mb-3 text-xl" for="structure_id">Structure :</label>
            <select name="structure_id" id="" class="mb-6 h-8 border-2 border-black">
                <option value="{{ old('structure_id', $event->structure_id) }}"  selected hidden>{{ $event->structure->name }}</option>
                @if($structures->count() > 0)
                @foreach($structures as $structure)
                <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                @endforeach
                @endif
            </select>


            <label class="mb-3 text-xl" for="partners">Partenaires organisateurs :</label>
            <input name="partners" class="mb-6 h-8 border-2 border-black" type="text" value="{{ old('partners', $event->partners) }}">



            <label class="mb-3 text-xl" for="name">Intitulé de l'événement :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $event->name) }}">


            <label class="mb-3 text-xl" for="description">Description courte de l'événement :</label>
            <textarea class="mb-6 h-8 border-2 border-black" name="description" id="" cols="30" rows="20">{{ $event->description }}</textarea>

            <label class="mb-3 text-xl" for="status_id">Etat d'avancement</label>
            @error('status')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('status') is-invalid @enderror" name="status_id" id="">
                <option value="{{ old('status_id', $event->status_id) }}"  selected hidden>{{ $event->status->name }}</option>
                @if($status->count() > 0)
                @foreach($status as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
                @endif
            </select>

            <label class="mb-3 text-xl" for="number_of_participants_id">Nombre de personnes présentes estimé</label>
            @error('nbre_people')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('nbre_people') is-invalid @enderror" name="number_of_participants_id">
                <option value="{{ old('number_of_participants_id', $event->number_of_participants_id) }}"  selected hidden>{{ $event->number_of_participants->name }}</option>
                @if($numberOfParticipants->count() > 0)
                @foreach($numberOfParticipants as $participants)
                <option value="{{ $participants->id }}">{{ $participants->name }}</option>
                @endforeach
                @endif
            </select>




            <label class="mb-3 text-xl" for="location">Lieu de l'événement :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('location') is-invalid @enderror" name="location" type="text" value="{{ old('location', $event->location) }}">

            <div id="date" class="">
                <label class="mb-3 text-xl" for="date-start">Date de début de l'événement :</label>
                @error('date_start')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('date_start') is-invalid @enderror" name="date_start" type="date" value="{{ old('date_start', $event->date_start) }}">

                <label class="mb-3 text-xl" for="date-end">Date de fin de l'événement :</label>
                @error('date_end')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('date_end') is-invalid @enderror" name="date_end" type="date" value="{{ old('date_end', $event->date_end) }}">
            </div>
            <label class="mb-3 text-xl" for="is_Fix">Les dates sont :</label>
            <span class="mb-3 text-xl">Fixe :</span>
            @error('is_Fix')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('is_Fix') is-invalid @enderror" name="is_Fix" type="checkbox" checked value="{{ old('is_Fix') }}">

            <span class="mb-3 text-xl">Prévisionnel :</span>
            @error('is_not_fix')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('is_not_fix') is-invalid @enderror" name="is_not_fix" type="checkbox" value="{{ old('is_not_fix') }}">

            <label class="mb-3 text-xl" for="hours">Heure de l'événement</label>
            @error('hours')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('hours') is-invalid @enderror" name="hours" type="text" value="{{ old('hours', $event->hours) }}">

            <label class="mb-3 text-xl" for="organizer_needs">Besoin de l'organisateur</label>
            <textarea class="mb-6 h-8 border-2 border-black" id="" name="organizer_needs" cols="30" rows="10">{{ old('needs_organizer', $event->organizer_needs) }}</textarea>

            <input type="submit" value="Envoyer">
        </form>
    <script>
        const dateKnow = document.getElementById("date");
        const dateExpect = document.getElementById("date_expect");
        const yes = document.getElementById('yes')
        const no = document.getElementById('no')

        yes.addEventListener("click", () => {
            no.checked = false;
            if (dateKnow.className.includes('hidden')) {
                dateKnow.classList.remove('hidden')
                dateExpect.classList.add('hidden')
            } else {
                dateKnow.classList.add('hidden')
            }
        })

        no.addEventListener("click", () => {
            yes.checked = false;
            if (dateExpect.className.includes('hidden')) {
                dateExpect.classList.remove('hidden')
                dateKnow.classList.add('hidden')
            } else {
                dateExpect.classList.add('hidden')
            }
        })
    </script>
</x-app-layout>