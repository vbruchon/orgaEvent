<!-- resources/views/components/filerbar.blade.php -->

@props(['structures', 'status', 'numberOfParticipants', 'selectedStructure', 'selectedStatus', 'selectedParticipant', 'route'])
<form action="{{ route($route) }}" method="get" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
    @csrf
    <label class="mb-3 text-xl" for="structure">Structure :</label>
    <select name="structure" id="structure" class="mb-6 h-8 border-2 border-black">
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

    <label class="mb-3 text-xl" for="status">Etat d'avancement</label>
    <select class="mb-6 h-8 border-2 border-black" name="status">
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

    <label class="mb-3 text-xl" for="number_of_participants">Nombre de personnes présentes estimé</label>
    <select class="mb-6 h-8 border-2 border-black @error('nbre_people') is-invalid @enderror" name="number_of_participants">
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
    <input type="submit" value="Envoyer">
</form>