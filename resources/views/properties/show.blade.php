<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Propiedad') }}
        </h2>
    </x-slot>

    <!-- Verificar si la propiedad está presente -->
    @if ($property)
        <div class="max-w-4xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $property->title }}</h1>
            <p class="text-lg text-gray-700 mb-4">{{ $property->description }}</p>
            <p class="text-xl font-semibold text-gray-800 mb-4">Precio: <span class="text-green-600">${{ number_format($property->price, 2) }}</span></p>
            <p class="text-md text-gray-600 mb-4">Tipo: <span class="font-medium">{{ ucfirst($property->type) }}</span></p>
            <p class="text-md text-gray-600 mb-6">Ubicación: <span class="font-medium">{{ $property->location }}</span></p>
            <a href="{{ route('properties.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                Volver a la lista de propiedades
            </a>
        </div>
    @else
        <!-- Si no hay propiedad -->
        <div class="text-center p-4">
            <p class="text-red-500">La propiedad solicitada no existe o no está disponible.</p>
        </div>
    @endif
</x-app-layout>
