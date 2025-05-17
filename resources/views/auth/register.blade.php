<x-guest-layout>
    <h1 class="text-xl mb-4">Registro</h1>
    <form id="register-form" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block mb-1">Nombre</label>
            <input id="name" type="text" placeholder="Nombre" required class="block mt-1 w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label for="email" class="block mb-1">Correo</label>
            <input id="email" type="email" placeholder="Correo" required class="block mt-1 w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label for="password" class="block mb-1">Contraseña</label>
            <input id="password" type="password" placeholder="Contraseña" required class="block mt-1 w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label for="password_confirmation" class="block mb-1">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" placeholder="Confirmar Contraseña" required class="block mt-1 w-full border rounded px-3 py-2" />
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Registrarse</button>
        </div>
        <div id="error" class="mt-4 text-red-600 font-bold"></div>
    </form>

    <script>
        document.getElementById('register-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            document.getElementById('error').textContent = '';

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;

            if (password !== password_confirmation) {
                document.getElementById('error').textContent = 'Las contraseñas no coinciden.';
                return;
            }

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        password,
                        password_confirmation
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    document.getElementById('error').textContent = errorData.message || 'Error en el registro.';
                    return;
                }

                const data = await response.json();
                localStorage.setItem('api_token', data.token);
                localStorage.setItem('user_name', data.user.name);
                window.location.href = '/dashboard';
            } catch (error) {
                document.getElementById('error').textContent = 'Error inesperado. Intenta de nuevo.';
                console.error(error);
            }
        });
    </script>
</x-guest-layout>