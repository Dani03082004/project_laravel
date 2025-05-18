<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Propiedad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="max-w-lg mx-auto">
                    <form id="create-form" class="space-y-4">
                        <div><input id="title" type="text" placeholder="Título" class="w-full p-2 border rounded" required></div>
                        <div><textarea id="description" placeholder="Descripción" class="w-full p-2 border rounded" required></textarea></div>
                        <div><input id="price" type="number" placeholder="Precio" class="w-full p-2 border rounded" required></div>
                        <div>
                            <select id="status" class="w-full p-2 border rounded">
                                <option value="sale">Venta</option>
                                <option value="rent">Alquiler</option>
                            </select>
                        </div>
                        <div><input id="location" type="text" placeholder="Ubicación" class="w-full p-2 border rounded" required></div>
                        <div><input id="size" type="number" placeholder="Tamaño m²" class="w-full p-2 border rounded" required></div>
                        <div>
                            <button type="submit" class="w-full bg-blue-500 text-white rounded p-2">Crear Propiedad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.apiToken = localStorage.getItem('api_token');

        document.getElementById('create-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const payload = {
                title: document.getElementById('title').value,
                description: document.getElementById('description').value,
                price: document.getElementById('price').value,
                status: document.getElementById('status').value,
                location: document.getElementById('location').value,
                size: document.getElementById('size').value
            };

            fetch('/api/properties', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(() => window.location.href = '/properties/index')
            .catch(() => alert('Error al crear la propiedad'));
        });
    </script>
</x-app-layout>