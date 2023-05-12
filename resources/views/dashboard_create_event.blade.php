<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <main class="w-full">


        <form action="" method="post" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
            @csrf
            <label class="mb-3 text-xl" for="structure">Structure :</label>
            <select name="structure" id="" class="mb-6 h-8 border-2 border-black"></select>

            <label class="mb-3 text-xl" for="partners">Partenaires organisateurs :</label>
            <select name="partners" id="" class="mb-6 h-8 border-2 border-black"></select>



            <label class="mb-3 text-xl" for="name">Intitulé de l'événement :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="mb-6 h-8 border-2 border-black @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}">


            <label class="mb-3 text-xl" for="short-desc">Description courte de l'événement :</label>
            <textarea class="mb-6 h-8 border-2 border-black" name="" id="" cols="30" rows="10"></textarea>

            <label class="mb-3 text-xl" for="status">Etat d'avancement</label>
            @error('status')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('status') is-invalid @enderror" name="status" id=""></select>

            <label class="mb-3 text-xl" for="nbre_people">Nombre de personnes présentes estimé</label>
            @error('nbre_people')<span class="text-red-600">{{ $message }}</span>@enderror
            <select class="mb-6 h-8 border-2 border-black @error('nbre_people') is-invalid @enderror" name="nbre_people" id=""></select>

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

            <label class="mb-3 text-xl" for="needs-organizer">Besoin de l'organisateur</label>
            <textarea class="mb-6 h-8 border-2 border-black" id="" name="needs_organizer" cols="30" rows="10" value="{{ old('needs_organizer') }}"></textarea>

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