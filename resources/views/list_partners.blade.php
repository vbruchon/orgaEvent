<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des structures') }}
        </h2>
    </x-slot>
    <main class="w-full mt-8">
        @if (session('success'))
        <div id="success-message" class="bg-green-400 p-6 text-center rounded shadow animate-movedown">
            {{ session('success') }}
        </div>
        @endif
        <main class="w-full mt-10">
            <a href="{{ route('partner.create') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">Ajouter un nouveau partenaire</a>
            <div class="table w-full p-2 mt-8">
                @if($partners->count() === 0)

                <p>Aucun partenaires trouvés</p>
                @else
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
                                    Nom du Partenaires
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                                <div class="flex items-center justify-center">
                                    Action
                                </div>
                            </th>
                        </tr>
                    </thead>


                    @foreach($partners as $partner)

                    <tbody>
                        <tr class="bg-gray-50 text-center">
                            <td class="p-2 border-r">
                        </tr>
                        <tr class="bg-gray-100 text-center border-b text-xl text-gray-600">
                            <td class="p-2 border-r">{{$partner->id}}</td>
                            <td class="p-2 border-r">{{$partner->name}}</td>
                            <td class="p-2 border-r">
                                <div class="flex space-x-1 justify-center">
                                    <a href="{{ route('partner.edit', $partner) }}" class="bg-fuchsia-700 p-2 pl-3 pr-3 text-white hover:shadow-lg text-lg font-semibold  ">
                                        Modifier
                                    </a>

                                    <form method="post" action="{{ route('partner.delete', $partner->id) }}">
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

                    @endif

                </table>
            </div>

        </main>
</x-app-layout>