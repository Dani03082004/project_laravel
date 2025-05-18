<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de las Propiedades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div id="properties-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <p>Cargando propiedades...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.apiToken = localStorage.getItem('api_token');
        if (!window.apiToken) {
            window.location.href = '/login';
        }

        fetch('/api/properties', {
            headers: {
                'Authorization': 'Bearer ' + window.apiToken,
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
                        <div class="flex justify-between mt-4 space-x-2">
                            <a href="/properties/edit/${property.id}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">Editar</a>
                            <form onsubmit="event.preventDefault(); deleteProperty(${property.id});">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">Eliminar</button>
                            </form>
                        </div>
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error(err);
            document.getElementById('properties-container').innerHTML = '<p>Error al cargar propiedades.</p>';
        });

        function deleteProperty(id) {
            if (!confirm('¿Seguro que deseas eliminar esta propiedad?')) return;
            fetch(`/api/properties/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + window.apiToken,
                    'Accept': 'application/json'
                }
            }).then(() => location.reload());
        }
    </script>
</x-app-layout>
