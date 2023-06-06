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

    <a href="{{route('userEvent.all')}}" class="w-1/6 mb-3 block ms-8 text-xl text-center text-white rounded-lg p-2.5 bg-fuchsia-900 transition duration-300 transform hover:scale-105">
        Retourner aux événements
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

    <form method="post" action="{{route('userEvent.update', $event)}}" class="bg-gray-100 block p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
        @csrf
        @method('put')
        <section class="relative border-2 border-custom-purple rounded-lg p-16 mb-12 ">
            <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-purple rounded-tl rounded-tr text-lg">Informations générales</h2>
            <div class="flex flex-col mb-4">
                <label class="mb-3 text-xl" for="name">Intitulé de l'événement :</label>
                @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $event->name) }}">
            </div>
            <div class="w-full flex place-content-between mb-4">
                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl" for="structure_id">Structure :</label>
                    <select name="structure_id" id="" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('structure_id') is-invalid @enderror">
                        <option value="{{ old('structure_id', $event->structure_id) }}" selected hidden>{{ $event->structure->name }}</option>
                        @if($structures->count() > 0)
                        @foreach($structures as $structure)
                        <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="flex flex-col w-3/5 mb-4">
                    <label class="mb-3 text-xl" for="partners">Partenaires organisateurs :</label>
                    <input name="partners" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2" type="text" value="{{ old('partners', $event->partners) }}">
                </div>
            </div>
            <div class="flex flex-col mb-8">
                <label class="mb-3 text-xl" for="description">Description courte de l'événement :</label>
                <textarea class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2" name="description" id="" cols="10" rows="1">{{ $event->description }}</textarea>
            </div>
            <div class="w-full flex place-content-between mb-4">
                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl" for="status_id">Etat d'avancement</label>
                    @error('status')<span class="text-red-600">{{ $message }}</span>@enderror
                    <select class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('status') is-invalid @enderror" name="status_id" id="">
                        <option value="{{ old('status_id', $event->status_id) }}" selected hidden>{{ $event->status->name }}</option>
                        @if($status->count() > 0)
                        @foreach($status as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="flex flex-col w-3/5 mr-8 mb-4">
                    <label class="mb-3 text-xl" for="number_of_participants_id">Nombre de personnes présentes estimé</label>
                    @error('nbre_people')<span class="text-red-600">{{ $message }}</span>@enderror
                    <select class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('nbre_people') is-invalid @enderror" name="number_of_participants_id">
                        <option value="{{ old('number_of_participants_id', $event->number_of_participants_id) }}" selected hidden>{{ $event->number_of_participants->name }}</option>
                        @if($numberOfParticipants->count() > 0)
                        @foreach($numberOfParticipants as $participants)
                        <option value="{{ $participants->id }}">{{ $participants->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </section>

        <section class="relative border-2 border-custom-purple rounded-lg p-16 mb-12 ">
            <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-purple rounded-tl rounded-tr text-lg">Planification de l'événement</h2>
            <div class="flex flex-col w-2/5 mr-8">

                <label class="mb-3 text-xl" for="location">Lieu de l'événement :</label>
                @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('location') is-invalid @enderror" name="location" type="text" value="{{ old('location', $event->location) }}">
            </div>
            <div id="date" class="w-full flex mb-6">
                <div class="w-2/5">
                    <label class="mb-3 text-xl" for="date-start">Date de début de l'événement :</label>
                    @error('date_start')<span class="text-red-600">{{ $message }}</span>@enderror
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('date_start') is-invalid @enderror" name="date_start" type="date" value="{{ old('date_start', $event->date_start) }}">
                </div>
                <div class="ml-12 w-2/5">
                    <label class="mb-3 text-xl" for="date-end">Date de fin de l'événement :</label>
                    @error('date_end')<span class="text-red-600">{{ $message }}</span>@enderror
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('date_end') is-invalid @enderror" name="date_end" type="date" value="{{ old('date_end', $event->date_end) }}">
                </div>
            </div>
            <div class="w-2/5 flex place-content-between mb-4">
                <label class="mb-3 text-xl" for="is_Fix">Les dates sont :</label>
                <span class="mb-3 text-xl">Fixe :</span>
                @error('is_Fix')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="accent-custom-purple @error('is_Fix') is-invalid @enderror" name="is_Fix" id="fix" type="checkbox" checked value="{{ old('is_Fix') }}">

                <span class="mb-3 text-xl">Prévisionnel :</span>
                @error('is_not_fix')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="accent-custom-purple @error('is_not_fix') is-invalid @enderror" name="is_not_fix" id="no-fix" type="checkbox" value="{{ old('is_not_fix') }}">
            </div>
            <div class="flex flex-col w-2/5 mr-8">

                <label class="mb-3 text-xl" for="hours">Heure de l'événement</label>
                @error('hours')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('hours') is-invalid @enderror" name="hours" type="text" value="{{ old('hours', $event->hours) }}">
            </div>
        </section>


        <section class="relative border-2 border-custom-purple rounded-lg p-16 mb-6 ">
            <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-purple rounded-tl rounded-tr text-lg">Informations Complémentaires</h2>
            <label class="mb-3 text-xl" for="organizer_needs">Besoin de l'organisateur</label>
            <textarea class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5" id="" name="organizer_needs" cols="100" rows="5">{{ old('needs_organizer', $event->organizer_needs) }}</textarea>
        </section>

        <input class="w-1/5 mb-3 cursor-pointer block mx-auto text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105" type="submit" value="Envoyer">
    </form>
    <script>

        var previsionnelCheckbox = document.getElementById("no-fix");
        var fixCheckbox = document.getElementById("fix");

        previsionnelCheckbox.addEventListener("click", function() {
            if (previsionnelCheckbox.checked) {
                fixCheckbox.checked = false;
            } else {
                fixCheckbox.checked = true;
            }
        });

        fixCheckbox.addEventListener("click", function() {
            if (previsionnelCheckbox.checked) {
                previsionnelCheckbox.checked = false;
            } else {
                previsionnelCheckbox.checked = true;
            }
        });
        
    </script>
</x-app-layout>