<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow" id="orders-container">
                Cargando pedidos...
            </div>
        </div>
    </div>

    <script>
        window.apiToken = localStorage.getItem('api_token');

        fetch('/api/orders', {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(res => res.json())
            .then(orders => {
                const container = document.getElementById('orders-container');
                if (orders.length === 0) return container.innerHTML = '<p>No hay pedidos.</p>';

                container.innerHTML = orders.map(order => `
                <div class="border-b mb-4 pb-2">
                    <h3 class="font-bold text-lg mb-2">Pedido #${order.id}</h3>
                    ${order.items.map(i => `
                        <div class="ml-4">- ${i.property.title} x ${i.quantity}</div>
                    `).join('')}
                </div>
            `).join('');
            });
    </script>
</x-app-layout>