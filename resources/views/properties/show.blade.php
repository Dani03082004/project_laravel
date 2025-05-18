<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Propiedades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div id="properties-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <p id="loading-message">Cargando propiedades...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.apiToken = localStorage.getItem('api_token');
        if (!token) {
            window.location.href = '/login';
        }

        fetch('/api/properties', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Error al obtener propiedades');
            return res.json();
        })
        .then(data => {
            const container = document.getElementById('properties-container');
            container.innerHTML = ''; 
            data.forEach(property => {
                container.innerHTML += `
                    <div class="bg-white border border-gray-300 p-6 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">${property.title}</h3>
                        <p class="text-lg text-gray-700 mb-4">${property.description}</p>
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-xl font-semibold text-gray-800">
                                Precio: <span class="text-green-600">$${parseFloat(property.price).toFixed(2)}</span>
                            </p>
                            <span class="text-md text-gray-600 font-medium">${property.status}</span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-md text-gray-600">Ubicación: <span class="font-medium">${property.location}</span></p>
                            <p class="text-md text-gray-600">Tamaño: <span class="font-medium">${property.size} m²</span></p>
                        </div>
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error(err);
            document.getElementById('properties-container').innerHTML = '<p>Error al cargar propiedades.</p>';
        });
    </script>
</x-app-layout>
