<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <main class="w-full">


        <form action="" method="post" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
            @csrf
            <label class="mb-3 text-xl" for="structures_id">Structure :</label>
            <select name="structures_id" id="" class="mb-6 h-8 border-2 border-black">
                <option value="" disabled selected hidden>Choisissez une structure</option>
                @if($structures->count() > 0)
                @foreach($structures as $structure)
                <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                @endforeach
                @endif
            </select>


            <label class="mb-3 text-xl" for="partners_id">Partenaires organisateurs :</label>
            <input name="partners_id" id="" class="mb-6 h-8 border-2 border-black" type="text" value="1">



            <label class="mb-3 text-xl" for="name">Intitulé de l'événement :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}">


            <label class="mb-3 text-xl" for="description">Description courte de l'événement :</label>
            <textarea class="mb-6 h-8 border-2 border-black" name="description" id="" cols="30" rows="10"></textarea>

            <label class="mb-3 text-xl" for="status">Etat d'avancement</label>
            @error('status')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('status') is-invalid @enderror" name="status" id="">
                <option value="" disabled selected hidden>Choisissez un status</option>
                <option value="en-réfléxion">En réfléxion</option>
                <option value="en_cours_de_montage">En cours de montage</option>
                <option value="planifié">Planifié</option>
                <option value="réalisé">Réalisé</option>
            </select>

            <label class="mb-3 text-xl" for="number_of_participants">Nombre de personnes présentes estimé</label>
            @error('nbre_people')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('nbre_people') is-invalid @enderror" name="number_of_participants" id="">
                <option value="" disabled selected hidden>Choisissez le nombre de personnes prévus</option>
                <option value="<50">Moins de 50 personnes</option>
                <option value="50 - 80">De 50 à 80 personnes</option>
                <option value="81 - 120">De 81 à 120 personnes</option>
                <option value="121 - 160">De 120 à 160 personnes</option>
                <option value="161 - 200">De 160 à 200 personnes</option>
                <option value=">200">Plus de 200 personnes</option>
            </select>

            <label class="mb-3 text-xl" for="condition-date">Connaissez-vous la date précise de l'événement ?</label>
            <div class="flex-row align-center">
                <input type="checkbox" name="yes" id="yes" value="yes">
                <span>Oui je connais la (les) date(s) exacte.</span>
            </div>
            <div class="flex-row align-center">
                <input type="checkbox" name="no" id="no">
                <span>Non je ne connais pas encore la (les) date(s) précise.</span>
            </div>

            <div id="date" class="hidden">
                <label class="mb-3 text-xl" for="date-start">Date de début de l'événement :</label>
                @error('date_start')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('date_start') is-invalid @enderror" name="date_start" type="date" value="{{ old('date_start') }}">

                <label class="mb-3 text-xl" for="date-end">Date de fin de l'événement :</label>
                @error('date_end')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('date_end') is-invalid @enderror" name="date_end" type="date" value="{{ old('date_end') }}">
            </div>
            <div id="date_expect" class="hidden">
                <label class="mb-3 text-xl" for="expected-date-start">Date de début envisagé :</label>
                @error('expected_date_start')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('expected_date_start') is-invalid @enderror" name="expected_date_start" type="date" value="{{ old('expected_date_start') }}">

                <label class="mb-3 text-xl" for="expected-date-end">Date de fin envisagé :</label>
                @error('expected_date_end')<span class="text-red-600">{{ $message }}</span>@enderror
                <input class="mb-6 h-8 border-2 border-black @error('expected_date_end') is-invalid @enderror" name="expected_date_end" type="date" value="{{ old('expected_date_end') }}">
            </div>


            <label class="mb-3 text-xl" for="hours-start">Heure de début</label>
            @error('hours_start')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('hours_start') is-invalid @enderror" name="hours_start" type="time" value="{{ old('hours_start') }}">

            <label class="mb-3 text-xl" for="hours-end">Heure de fin</label>
            @error('hours_end')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('hours_end') is-invalid @enderror" name="hours_end" type="time" value="{{ old('hours_end') }}">

            <label class="mb-3 text-xl" for="organizer_needs">Besoin de l'organisateur</label>
            <textarea class="mb-6 h-8 border-2 border-black" id="" name="organizer_needs" cols="30" rows="10">{{ old('needs_organizer') }}</textarea>

            <input type="submit" value="Envoyer">
        </form>

    </main>
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

<!--     <script src="https://cdn.tailwindcss.com"></script>
 -->