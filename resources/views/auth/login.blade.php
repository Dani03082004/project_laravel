<x-guest-layout>
    <h1 class="text-xl mb-4">Login</h1>
    <form id="login-form">
        @csrf
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required class="block mt-1 w-full" autocomplete="username" />
        </div>
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required class="block mt-1 w-full" autocomplete="current-password" />
        </div>
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Login</button>
        </div>
        <div id="error" class="mt-4 text-red-600 font-bold"></div>
    </form>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            document.getElementById('error').textContent = ''; 

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                if (!response.ok) {
                    if (response.status === 401) {
                        document.getElementById('error').textContent = 'Credenciales incorrectas';
                    } else {
                        document.getElementById('error').textContent = 'Error en la conexión. Intenta de nuevo.';
                    }
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
