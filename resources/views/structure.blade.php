<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des structures') }}
        </h2>
    </x-slot>
    <main class="w-full mt-8">
        <a href="{{ route('add.structure') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">Ajouter une nouvelle structure</a>
        <div class="table w-full p-2 mt-8">
            <table class="w-3/4 border mx-auto my-4">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                ID
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Nom de la structure
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Action
                            </div>
                        </th>
                    </tr>
                </thead>

                @foreach($structures as $structure)

                <tbody>
                    <tr class="bg-gray-50 text-center">
                        <td class="p-2 border-r">
                    </tr>
                    <tr class="bg-gray-100 text-center border-b text-xl text-gray-600">
                        <td class="p-2 border-r">{{$structure->id}}</td>
                        <td class="p-2 border-r">{{$structure->name}}</td>
                        <td class="p-2 border-r">
                            <div class="flex space-x-1 justify-center">
                                <a href="" class="bg-fuchsia-700 p-2 pl-3 pr-3 text-white hover:shadow-lg text-lg font-semibold  ">
                                    Modifier
                                </a>

                                <form method="post" action="">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 p-2 pl-3 pr-3 text-white hover:shadow-lg text-lg font-semibold">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach

            </table>
        </div>

    </main>
</x-app-layout>