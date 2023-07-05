<x-app-layout>
    <x-slot name="header">
        <h2 class="ml-6 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un événement') }}
        </h2>
    </x-slot>
    <main class="w-full">

        <div class="ml-6 mt-6 ">
            <x-custom-button route="userEvent.all" content="Retourner aux événements" />
        </div>

        @if ($errors->any())
        <div class="bg-red-400 p-6 text-center m-6 rounded shadow border border-red-800">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('userEvent.add') }}" method="POST" class="bg-gray-100 block p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
            @csrf
            <section class="relative border-2 border-custom-light-purple rounded-lg p-16 mb-12 ">
                <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Informations générales</h2>

                <div class="flex flex-col mb-4">
                    <label class="mb-3 text-xl" for="name">Intitulé de l'événement <span class="text-red-600">*</span> :</label>
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}" placeholder="Veuillez renseigner le nom de l'événement">
                    @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
                </div>

                <div class="w-full flex place-content-between mb-4">
                    <div class="flex flex-col w-2/5 mr-8">
                        <label class="mb-3 text-xl" for="structure_id">Structure <span class="text-red-600">*</span> :</label>
                        <select name="structure_id" id="" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('structure_id') is-invalid @enderror">
                            <option value="" disabled selected hidden>Choisissez une structure</option>
                            @if($structures->count() > 0)
                            @foreach($structures as $structure)
                            <option value="{{ $structure->id }}" @if(old('structure_id')==$structure->id) selected @endif>{{ $structure->name }}</option> @endforeach
                            @endif
                        </select>
                        @error('structure_id')<span class="text-red-600">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col w-3/5 mb-4">
                        <label class="mb-3 text-xl" for="partners">Partenaires organisateurs :</label>
                        <input name="partners" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2" type="text" value="{{ old('partners') }}" placeholder='Séparer chaque partenaire par une virgule  " , "'>
                    </div>
                </div>

                <div class="flex flex-col mb-8">
                    <label class="mb-3 text-xl" for="description">Description courte de l'événement <span class="text-red-600">*</span> :</label>
                    <textarea class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-3/5 @error('description') is-invalid @enderror" name="description" cols="10" rows="3" placeholder="Veuillez décrire le but de l'événement."></textarea>
                    @error('description')<span class="text-red-600">{{ $message }}</span>@enderror
                </div>

                <div class="w-full flex place-content-between mb-4">
                    <div class="flex flex-col w-3/5 mr-8 mb-4">
                        <label class="mb-3 text-xl" for="number_of_participants_id">Nombre de personnes présentes estimé <span class="text-red-600">*</span> :</label>
                        <select class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('nbre_people') is-invalid @enderror" name="number_of_participants_id">
                            <option value="" disabled selected hidden>Choisissez le nombre de personnes prévus</option>
                            @if($numberOfParticipants->count() > 0)
                            @foreach($numberOfParticipants as $participants)

                            <option value="{{ $participants->id }}" @if(old('number_of_participants_id')==$participants->id) selected @endif>{{ $participants->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('nbre_people')<span class="text-red-600">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl" for="accessType_id">Type d'événement <span class="text-red-600">*</span> :</label>
                    <select name="accessType_id" id="" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('accessType_id') is-invalid @enderror">
                        <option value="" disabled selected hidden>Choisissez un type</option>
                        @if($accessType->count() > 0)
                        @foreach($accessType as $type)
                        <option value="{{ $type->id }}" @if(old('accessType_id')==$type->id) selected @endif>{{ $type->name }}</option> @endforeach
                        @endif
                    </select>
                    @error('accessType_id')<span class="text-red-600">{{ $message }}</span>@enderror
                </div>
                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl">Tags <span class="text-red-600">*</span> :</label>
                    @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('tags') is-invalid @enderror" @if(is_array(old('tags')) && in_array($tag->id, old('tags'))) checked @endif>
                        {{ $tag->name }}
                    </label>
                    @endforeach
                    @error('tags')<span class="text-red-600">{{ $message }}</span>@enderror
                </div>
            </section>
            <section class="relative border-2 border-custom-light-purple rounded-lg p-16 mb-12 ">
                <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Planification de l'événement</h2>
                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl" for="location">Lieu de l'événement :</label>
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 mb-6" name="location" type="text" value="{{ old('location') }}" placeholder="Veuillez renseigner le lieu de l'événement">
                </div>

                <div class="w-1/2 flex place-content-between mb-4">
                    <label class="mb-3 text-xl" for="is_Fix">Les dates sont <span class="text-red-600">*</span> :</label>
                    <span class="mb-3 text-xl">Fixes :</span>
                    <input class="accent-custom-light-purple -mt-2 @error('is_Fix') is-invalid @enderror" name="is_Fix" type="checkbox" id="fix" checked value="{{ old('is_Fix') }}">
                    @error('is_Fix')<span class="text-red-600">{{ $message }}</span>@enderror

                    <span class="mb-3 text-xl">Prévisionnelles :</span>
                    <input class="accent-custom-light-purple -mt-2 @error('is_not_fix') is-invalid @enderror" name="is_not_fix" type="checkbox" id="no-fix" value="{{ old('is_not_fix') }}">
                    @error('is_not_fix')<span class="text-red-600">{{ $message }}</span>@enderror
                </div>

                <div id="is_fix" class="mb-8">
                    <p class="italic">Veuillez sélectionner la date de début et la date de fin de l'événement.</p>
                </div>
                <div id="is_not_fix" class="mb-8">
                    <p class="italic">Veuillez indiquer la période durant laquelle l'événement se déroulera.</p>
                </div>

                <div id="date" class="w-full flex mb-6">
                    <div class="w-2/5">
                        <label class="mb-3 text-xl" for="date-start">Début :<span class="text-red-600">*</span> :</label>
                        <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-2/5 @error('date_start') is-invalid @enderror" name="date_start" type="date" value="{{ old('date_start') }}">
                    </div>
                    <div class="ml-12 w-2/5">
                        <label class="mb-3 text-xl" for="date-end">Fin :</label>
                        <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-2/5 @error('date_end') is-invalid @enderror" name="date_end" type="date" value="{{ old('date_end') }}">
                    </div>
                </div>
                @error('date_start')<span class="text-red-600">{{ $message }}</span>@enderror
                @error('date_end')<span class="text-red-600">{{ $message }}</span>@enderror

                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl">Heure de l'événement :</label>
                    <input class="mb-6 h-8 border-2 border-grey-300 @error('hours_start') is-invalid @enderror" name="hours" type="text" value="{{ old('hours') }}" placeholder="Veuillez respecter se format ( 18:00 - 22:00 )">
                    @error('hours_start')<span class=" text-red-600">{{ $message }}</span>@enderror
                </div>
            </section>
            <section class="relative border-2 border-custom-light-purple rounded-lg p-16 mb-6 ">
                <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Informations Complémentaires</h2>
                <label class="mb-3 text-xl" for="organizer_needs">Besoin de l'organisateur</label>
                <textarea class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-full" id="" name="organizer_needs" cols="10" rows="5" placeholder="Si vous avez des besoins spécifique veuillez les saisir ici...">{{ old('needs_organizer') }}</textarea>
            </section>
            <x-submitInput label="Publier l'événement" />

        </form>

    </main>
    <script src="{{ asset('js/form.js') }}"></script>
 
</x-app-layout>

<!--     <script src="https://cdn.tailwindcss.com"></script>
 -->