<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Propiedad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="max-w-lg mx-auto">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Detalles de la Propiedad</h3>
                    <form action="{{ route('properties.update', $property) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" id="title" name="title" value="{{ $property->title }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>{{ $property->description }}</textarea>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                            <input type="number" id="price" name="price" value="{{ $property->price }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Tipo</label>
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                                <option value="sale" {{ $property->status == 'sale' ? 'selected' : '' }}>Venta</option>
                                <option value="rent" {{ $property->status == 'rent' ? 'selected' : '' }}>Alquiler</option>
                            </select>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                            <input type="text" id="location" name="location" value="{{ $property->location }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                        </div>

                        <div>
                            <label for="size" class="block text-sm font-medium text-gray-700">Tamaño (m²)</label>
                            <input type="number" id="size" name="size" value="{{ $property->size }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">
                                Actualizar Propiedad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
