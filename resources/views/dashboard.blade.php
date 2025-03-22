<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ __("¡Bienvenido, " . auth()->user()->name . "!") }}
                </h3>

                @if(auth()->user()->hasRole('admin'))
                    <p class="text-gray-700">{{ __("Te encuentras registrado como Administrador en InmoGest.") }}</p>
                @elseif(auth()->user()->hasRole('member'))
                    <p class="text-gray-700">{{ __("Te encuentras registrado como Usuario en InmoGest.") }}</p>
                @endif

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Listado de Propiedades -->
                    <div class="bg-blue-100 p-4 rounded-lg shadow">
                        <h4 class="text-lg font-semibold text-blue-800">Listado de Propiedades</h4>
                        @if(auth()->user()->hasRole('admin'))
                            <p class="text-blue-600">{{ App\Models\Property::count() }} propiedades registradas</p>
                        @elseif(auth()->user()->hasRole('member'))
                            <p class="text-blue-600">{{ auth()->user()->properties->count() ?? 0 }} propiedades registradas</p>
                        @endif
                        <a href="{{ route('properties.show') }}" class="inline-block mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Ver Propiedades
                        </a>
                    </div>

                    <!-- Gestión de Propiedades -->
                    <div class="bg-yellow-100 p-4 rounded-lg shadow">
                        <h4 class="text-lg font-semibold text-yellow-800">Gestión de Propiedades</h4>
                        <p class="text-yellow-600">Administra tus propiedades existentes</p>
                        <a href="{{ route('properties.index') }}" class="inline-block mt-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            Gestionar Propiedades
                        </a>
                    </div>

                    <!-- Crear Propiedades (Solo para admins y miembros) -->
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('member'))
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold text-green-800">Nueva Propiedad</h4>
                            <p class="text-green-600">Publica una nueva propiedad en InmoGest</p>
                            <a href="{{ route('properties.create') }}" class="inline-block mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                Añadir Propiedad
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
