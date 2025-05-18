<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eliminar Propiedad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="max-w-lg mx-auto text-center">
                    <h3 class="text-2xl font-bold mb-4">¿Eliminar esta propiedad?</h3>
                    <div class="flex justify-center gap-4">
                        <button onclick="deleteProperty()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">Eliminar</button>
                        <a href="/properties/index" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.apiToken = localStorage.getItem('api_token');
        const propertyId = window.location.pathname.split('/').pop();

        function deleteProperty() {
            if (!confirm("¿Estás seguro?")) return;

            fetch(`/api/properties/${propertyId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                })
                .then(() => window.location.href = '/properties/index')
                .catch(() => alert('Error al eliminar la propiedad'));
        }
    </script>
</x-app-layout>