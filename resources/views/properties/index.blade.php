<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de las Propiedades') }}
        </h2>
    </x-slot>

    @php
    $user = Auth::user();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($properties as $property)
                    <div class="bg-white border border-gray-300 p-6 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $property->title }}</h3>
                        <p class="text-lg text-gray-700 mb-4">{{ $property->description }}</p>

                        <div class="flex justify-between mt-4 space-x-2">
                            @can('update', $property)
                            <a href="{{ route('properties.edit', $property) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">Editar</a>
                            @endcan

                            @can('delete', $property)
                            <form action="{{ route('properties.destroy', $property) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">Eliminar</button>
                            </form>
                            @endcan

                            <a href="{{ route('properties.show', $property) }}" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">Ver Detalles</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
