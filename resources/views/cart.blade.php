<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Carrito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <div id="cart-items">Cargando...</div>
                <div class="mt-4 flex justify-between">
                    <button onclick="clearCart()" class="bg-red-500 text-white px-4 py-2 rounded">Vaciar Carrito</button>
                    <button onclick="checkout()" class="bg-green-500 text-white px-4 py-2 rounded">Comprar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.apiToken = localStorage.getItem('api_token');

        function loadCart() {
            fetch('/api/cart', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error al obtener carrito');
                    return res.json();
                })
                .then(items => {
                    const container = document.getElementById('cart-items');
                    if (!Array.isArray(items)) throw new Error('Respuesta inválida');
                    if (items.length === 0) return container.innerHTML = '<p>El carrito está vacío.</p>';

                    container.innerHTML = items.map(item => `
                <div class="border-b py-2 flex justify-between">
                    <div>${item.property.title} (${item.quantity})</div>
                    <button onclick="removeItem(${item.id})" class="text-red-600">Eliminar</button>
                </div>
            `).join('');
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('cart-items').innerHTML = '<p>Error al cargar el carrito.</p>';
                });
        }

        function removeItem(id) {
            fetch(`/api/cart/remove/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            }).then(loadCart);
        }

        function clearCart() {
            fetch('/api/cart/clear', {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            }).then(loadCart);
        }

        function checkout() {
            fetch('/api/checkout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then(res => res.json())
                .then(() => {
                    alert('Compra realizada');
                    loadCart();
                });
        }

        loadCart();
    </script>
</x-app-layout>