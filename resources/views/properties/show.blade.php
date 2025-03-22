<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Propiedades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($properties as $property)
                    <div class="bg-white border border-gray-300 p-6 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $property->title }}</h3>
                        <p class="text-lg text-gray-700 mb-4">{{ $property->description }}</p>

                        <div class="flex justify-between items-center mb-4">
                            <p class="text-xl font-semibold text-gray-800">
                                Precio: <span class="text-green-600">${{ number_format($property->price, 2) }}</span>
                            </p>
                            <span class="text-md text-gray-600 font-medium">{{ ucfirst($property->status) }}</span>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <p class="text-md text-gray-600">Ubicación: <span class="font-medium">{{ $property->location }}</span></p>
                            <p class="text-md text-gray-600">Tamaño: <span class="font-medium">{{ $property->size }} m²</span></p>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>