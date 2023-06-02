<!-- resources/views/components/filerbar.blade.php -->

@props(['structures', 'status', 'numberOfParticipants', 'selectedStructure', 'selectedStatus', 'selectedParticipant', 'route'])
<form id="filterbar" action="{{ route($route) }}" method="get" class="p-8">    @csrf
        <div class="flex flex-col mb-4">
            <label class="mb-3 text-lg" for="structure">Structure :</label>
            <select name="structure" id="structure" class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-5/6">
                <option value="" disabled selected hidden>Choisissez une structure</option>
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

        <div class="flex flex-col mb-4">
            <label class="mb-3 text-lg" for="status">Etat d'avancement</label>
            <select class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-5/6" name="status">
                <option value="" disabled selected hidden>Choisissez un status</option>
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
            <div class="flex flex-col mb-4">
                <label class="mb-3 text-lg" for="number_of_participants">Nombre de personnes présentes estimé</label>
                <select class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-5/6 @error('nbre_people') is-invalid @enderror" name="number_of_participants">
                    <option value="" disabled selected hidden>Choisissez le nombre de personnes prévus</option>
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
</form>

<script>
    // Obtenir le formulaire
    const form = document.getElementById('filterbar');

    // Ajouter un événement lors du changement de la sélection
    form.addEventListener('change', function() {
        // Soumettre le formulaire
        form.submit();
    });
</script>