<!-- resources/views/components/filerbar.blade.php -->

@props(['structures', 'status', 'numberOfParticipants', 'selectedStructure', 'selectedStatus', 'selectedParticipant', 'route'])

@php
$selectOptions = [
'structure' => [
'label' => 'Structure',
'options' => $structures,
'selected' => $selectedStructure ?? "",
],
'status' => [
'label' => 'Etat d\'avancement',
'options' => $status,
'selected' => $selectedStatus ?? "",
],
'number_of_participants' => [
'label' => 'Nombre de personnes présentes estimé',
'options' => $numberOfParticipants,
'selected' => $selectedParticipant ?? "",
],
];
@endphp

<form id="filterbar" action="{{ route($route) }}" method="get" class="px-8 py-4 flex justify-evenly w-full bg-white">
    @csrf
    @foreach($selectOptions as $key => $selectOption)
    <div class="flex flex-col mb-4 mr-10">
        <label class="mb-3 text-lg text-custom-blue" for="{{ $key }}">{{ $selectOption['label'] }}</label>
        <select name="{{ $key }}" id="{{ $key }}" class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-full">
            <option value="" disabled selected hidden>Choisissez une structure</option>
            @if($selectOption['options']->count() > 0)
            @foreach ($selectOption['options'] as $option)
            @if(isset($option))
            <option value="{{ $option->name }}" {{ $selectOption['selected'] == $option->name ? 'selected' : '' }}>
                {{ $option->name }}
            </option>
            @else
            <option value="{{ $option->name }}">{{ $option->name }}</option>
            @endif
            @endforeach
            @endif
            <option value=""><hr class="mt-6 mb-4 border-gray-300 dark:border-gray-700"></option>

            <option value="">Réinitialiser</option>
        </select>
    </div>
    @endforeach
    <button class="hidden" type="submit">Filtrer</button>
    <button class="hidden" type="button" onclick="resetFilters()">Réinitialiser</button> <!-- Bouton de réinitialisation -->
</form>
<script src="{{ asset('js/filterbar.js') }}"></script>




