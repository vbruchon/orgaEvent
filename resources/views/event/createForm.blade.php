<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <form action="{{ route('event.add') }}" method="POST" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
            @csrf
            <label class="mb-3 text-xl" for="structure_id">Structure :</label>
            <select name="structure_id" id="" class="mb-6 h-8 border-2 border-black">
                <option value="" disabled selected hidden>Choisissez une structure</option>
                @if($structures->count() > 0)
                @foreach($structures as $structure)
                <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                @endforeach
                @endif
            </select>


            <label class="mb-3 text-xl" for="partners">Partenaires organisateurs :</label>
            <input name="partners" class="mb-6 h-8 border-2 border-black" type="text" value="{{ old('partners') }}">



            <label class="mb-3 text-xl" for="name">Intitulé de l'événement :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}">


            <label class="mb-3 text-xl" for="description">Description courte de l'événement :</label>
            <textarea class="mb-6 h-8 border-2 border-black" name="description" id="" cols="30" rows="20"></textarea>

            <label class="mb-3 text-xl" for="status_id">Etat d'avancement</label>
            @error('status')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('status') is-invalid @enderror" name="status_id" id="">
                <option value="" disabled selected hidden>Choisissez un status</option>
                @if($status->count() > 0)
                @foreach($status as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
                @endif
            </select>

            <label class="mb-3 text-xl" for="number_of_participants_id">Nombre de personnes présentes estimé</label>
            @error('nbre_people')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('nbre_people') is-invalid @enderror" name="number_of_participants_id" >
                <option value="" disabled selected hidden>Choisissez le nombre de personnes prévus</option>
                @if($numberOfParticipants->count() > 0)
                @foreach($numberOfParticipants as $participants)
                <option value="{{ $participants->id }}">{{ $participants->name }}</option>
                @endforeach
                @endif
            </select>




            <label class="mb-3 text-xl" for="location">Lieu de l'événement :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('location') is-invalid @enderror" name="location" type="text" value="{{ old('location') }}">

            <div id="date" class="">
                <label class="mb-3 text-xl" for="date-start">Date de début de l'événement :</label>
                @error('date_start')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('date_start') is-invalid @enderror" name="date_start" type="date" value="{{ old('date_start') }}">

                <label class="mb-3 text-xl" for="date-end">Date de fin de l'événement :</label>
                @error('date_end')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('date_end') is-invalid @enderror" name="date_end" type="date" value="{{ old('date_end') }}">
            </div>
            

            <label class="mb-3 text-xl" for="hourse">Heure de l'événement</label>
            @error('hours_start')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('hours_start') is-invalid @enderror" name="hours" type="text" value="{{ old('hours') }}">

            <label class="mb-3 text-xl" for="organizer_needs">Besoin de l'organisateur</label>
            <textarea class="mb-6 h-8 border-2 border-black" id="" name="organizer_needs" cols="30" rows="10">{{ old('needs_organizer') }}</textarea>

            <input type="submit" value="Envoyer">
        </form>

    </main>

</x-app-layout>

<!--     <script src="https://cdn.tailwindcss.com"></script>
 -->