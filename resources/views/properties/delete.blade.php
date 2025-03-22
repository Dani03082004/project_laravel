<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eliminar Propiedad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="max-w-lg mx-auto">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">¿Estás seguro de que quieres eliminar esta propiedad?</h3>
                    <form action="{{ route('properties.destroy', $property) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="flex justify-between">
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">
                                Eliminar
                            </button>
                            <a href="{{ route('properties.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
