<!-- resources/views/components/FormEdit.blade.php -->

@props(['route', 'model'])

<form action="{{ route($route, $model) }}" method="post" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-3/4 justify-center mx-auto mt-8 mb-6">
    @csrf
    @method('put')
    <label class="mb-3 text-xl" for="name">Nom :</label>
    @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
    <input class="mb-6 h-8 border-2 border-black @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $model->name) }}">

    <input type="submit" value="Envoyer">
</form>
