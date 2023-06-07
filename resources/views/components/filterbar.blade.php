<!-- resources/views/components/filerbar.blade.php -->

@props(['structures', 'status', 'numberOfParticipants', 'selectedStructure', 'selectedStatus', 'selectedParticipant', 'route'])

<form id="filterbar" action="{{ route($route) }}" method="get" class="px-8 py-4 flex justify-evenly w-full bg-white">
    @csrf
    <div class="flex flex-col mb-4 mr-10">
        <label class="mb-3 text-lg text-custom-blue" for="structure">Structure :</label>
        <select name="structure" id="structure" class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-full">
            <option value="" disabled selected hidden>Choisissez une structure</option>
            <option value="">Réinitialiser</option>
            @if($structures->count() > 0)
            @foreach ($structures as $structure)
            @if(isset($selectedStructure))
            <option value="{{ $structure->name }}" {{ $selectedStructure == $structure->name ? 'selected' : '' }}>
                {{ $structure->name }}
            </option>
            @else
            <option value="{{ $structure->name }}">{{ $structure->name }}</option>
            @endif
            @endforeach
            @endif
        </select>
    </div>

    <div class="flex flex-col mb-4 mr-10">
        <label class="mb-3 text-lg text-custom-blue" for="status">Etat d'avancement</label>
        <select class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-full" name="status" id="status">
            <option value="" disabled selected hidden>Choisissez un status</option>
            <option value="">Réinitialiser</option> <!-- Option de réinitialisation -->
            @if($status->count() > 0)
            @foreach($status as $state)
            @if(isset($selectedStatus))
            <option value="{{ $state->name }}" {{ $selectedStatus == $state->name ? 'selected' : '' }}>
                {{ $state->name }}
            </option>
            @else
            <option value="{{ $state->name }}">{{ $state->name }}</option>
            @endif
            @endforeach
            @endif
        </select>
    </div>

    <div class="flex flex-col mb-4 mr-10">
        <label class="mb-3 text-lg text-custom-blue" for="number_of_participants">Nombre de personnes présentes estimé</label>
        <select class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-full @error('nbre_people') is-invalid @enderror" id="participants" name="number_of_participants">
            <option value="" disabled selected hidden>Choisissez le nombre de personnes prévues</option>
            <option value="">Réinitialiser</option> <!-- Option de réinitialisation -->
            @if($numberOfParticipants->count() > 0)
            @foreach($numberOfParticipants as $participants)
            @if(isset($selectedParticipant))
            <option value="{{ $participants->name }}" {{ $selectedParticipant == $participants->name ? 'selected' : '' }}>
                {{ $participants->name }}
            </option>
            @else
            <option value="{{ $participants->name }}">{{ $participants->name }}</option>
            @endif
            @endforeach
            @endif
        </select>
    </div>

    <button class="hidden" type="submit">Filtrer</button>
    <button class="hidden" type="button" onclick="resetFilters()">Réinitialiser</button> <!-- Bouton de réinitialisation -->
</form>

<script>
    // Obtenir le formulaire
    const form = document.getElementById('filterbar');
    const structure = document.getElementById('structure');
    const status = document.getElementById('status');
    const participants = document.getElementById('participants');

    const selectElements = [
        document.getElementById('structure'),
        document.getElementById('status'),
        document.getElementById('participants')
    ]
    selectElements.forEach(select => {
        // Ajouter un événement lors du changement de la sélection
        select.addEventListener('change', function() {
            // Empêcher le comportement par défaut de soumission du formulaire
            event.preventDefault();
            // Récupérer les paramètres du formulaire
            var formData = new FormData(form);
            console.log(formData)
            // Construire l'URL avec les paramètres
            var url = form.action + '?' + new URLSearchParams(formData).toString();

            // Rediriger vers la nouvelle URL
            window.location.href = url;
        });
    });





    // Fonction de réinitialisation des filtres
    function resetFilters() {
        // Réinitialiser les sélections des menus déroulants
        document.getElementById('structure').selectedIndex = 0;
        document.getElementById('status').selectedIndex = 0;
        document.getElementById('number_of_participants').selectedIndex = 0;

        // Soumettre le formulaire pour appliquer les filtres réinitialisés
        form.submit();
    }
</script>