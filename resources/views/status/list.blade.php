<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des status') }}
        </h2>
    </x-slot>
    <main class="w-full mt-8">
        @if (session('success'))
        <div id="success-message" class="bg-green-400 p-6 text-center rounded shadow animate-movedown">
            {{ session('success') }}
        </div>
        @endif
        <main class="w-full mt-10">
            <a href="{{ route('admin.status.create') }}" class="ml-5 mb-3 text-xl text-white rounded-lg p-5 bg-fuchsia-900">Ajouter un nouveau status</a>
            <div class="table w-full p-2 mt-8">
                <table class="w-11/12 border mx-auto my-4">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                                <div class="flex items-center justify-center">
                                    ID
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                                <div class="flex items-center justify-center">
                                    Nom du status
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                                <div class="flex items-center justify-center">
                                    Action
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($status as $s)

                        <tr class="bg-gray-100 text-center border-b text-xl text-gray-600">
                            <td class="p-2 border-r py-4">{{$s->id}}</td>
                            <td class="p-2 border-r py-4">{{$s->name}}</td>
                            <td class="p-2 border-r py-4">
                                <div class="flex space-x-1 justify-center">
                                    <a href="{{ route('admin.status.edit', $s) }}" class="bg-fuchsia-700 p-2 pl-3 pr-3 text-white hover:shadow-lg text-lg font-semibold  ">
                                        Modifier
                                    </a>

                                    <form method="post" action="{{ route('admin.status.destroy', ['status' => $s]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="bg-red-500 p-2 pl-3 pr-3 text-white hover:shadow-lg text-lg font-semibold">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </main>
</x-app-layout>