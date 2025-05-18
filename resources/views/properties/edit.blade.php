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
                    <form id="edit-form" class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md p-2" required>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md p-2" required></textarea>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                            <input type="number" id="price" name="price" class="mt-1 block w-full border-gray-300 rounded-md p-2" required>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Tipo</label>
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md p-2">
                                <option value="sale">Venta</option>
                                <option value="rent">Alquiler</option>
                            </select>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                            <input type="text" id="location" name="location" class="mt-1 block w-full border-gray-300 rounded-md p-2" required>
                        </div>

                        <div>
                            <label for="size" class="block text-sm font-medium text-gray-700">Tamaño (m²)</label>
                            <input type="number" id="size" name="size" class="mt-1 block w-full border-gray-300 rounded-md p-2" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">
                                Actualizar Propiedad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const propertyId = window.location.pathname.split("/").pop();
        window.apiToken = localStorage.getItem('api_token');

        // Cargar datos
        fetch(`/api/properties/${propertyId}`, {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            const p = data.property;
            document.getElementById('title').value = p.title;
            document.getElementById('description').value = p.description;
            document.getElementById('price').value = p.price;
            document.getElementById('status').value = p.status;
            document.getElementById('location').value = p.location;
            document.getElementById('size').value = p.size;
        });

        // Enviar actualización
        document.getElementById('edit-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const payload = {
                title: document.getElementById('title').value,
                description: document.getElementById('description').value,
                price: document.getElementById('price').value,
                status: document.getElementById('status').value,
                location: document.getElementById('location').value,
                size: document.getElementById('size').value
            };

            fetch(`/api/properties/${propertyId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                alert('Propiedad actualizada correctamente');
                window.location.href = "/properties/index";
            })
            .catch(err => {
                console.error(err);
                alert('Error al actualizar la propiedad');
            });
        });
    </script>
</x-app-layout>
