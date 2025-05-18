<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 id="welcome-message" class="text-2xl font-bold text-gray-900 mb-4">
                    ¡Bienvenido, <span id="user-name">Invitado</span>!
                </h3>
                <p id="email-message" class="text-gray-700 mb-4"></p>
                <p id="role-message" class="text-gray-700 mb-4"></p>

                <div id="admin-message" class="text-gray-700 mb-4" style="display:none;">
                    Te encuentras registrado como Administrador en InmoGest.
                </div>
                <div id="member-message" class="text-gray-700 mb-4" style="display:none;">
                    Te encuentras registrado como Usuario en InmoGest.
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-blue-100 p-4 rounded-lg shadow">
                        <h4 class="text-lg font-semibold text-blue-800">Listado de Propiedades</h4>
                        <p id="properties-count" class="text-blue-600">Cargando propiedades...</p>
                        <a href="{{ route('properties.show') }}" class="inline-block mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Ver Propiedades
                        </a>
                    </div>

                    <div class="bg-yellow-100 p-4 rounded-lg shadow">
                        <h4 class="text-lg font-semibold text-yellow-800">Gestión de Propiedades</h4>
                        <p class="text-yellow-600">Administra tus propiedades existentes</p>
                        <a href="{{ route('properties.index') }}" class="inline-block mt-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            Gestionar Propiedades
                        </a>
                    </div>

                    <div id="new-property-section" class="bg-green-100 p-4 rounded-lg shadow" style="display:none;">
                        <h4 class="text-lg font-semibold text-green-800">Nueva Propiedad</h4>
                        <p class="text-green-600">Publica una nueva propiedad en InmoGest</p>
                        <a href="{{ route('properties.create') }}" class="inline-block mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            Añadir Propiedad
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (async () => {
            window.apiToken = localStorage.getItem('api_token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            try {
                const response = await fetch('/api/user-data', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Token inválido o expirado');
                }

                const data = await response.json();

                document.getElementById('user-name').textContent = data.name;
                document.getElementById('email-message').textContent = `Email: ${data.email}`;

                const rolesText = data.role_names.length ? data.role_names.join(', ') : 'Sin roles asignados';
                document.getElementById('role-message').textContent = `Rol(es): ${rolesText}`;

                if (data.is_admin) {
                    document.getElementById('admin-message').style.display = 'block';
                    document.getElementById('member-message').style.display = 'none';
                } else if (data.is_member) {
                    document.getElementById('member-message').style.display = 'block';
                    document.getElementById('admin-message').style.display = 'none';
                } else {
                    document.getElementById('admin-message').style.display = 'none';
                    document.getElementById('member-message').style.display = 'none';
                }

                if (data.is_admin) {
                    document.getElementById('properties-count').textContent = `${data.properties_count} propiedades registradas`;
                } else if (data.is_member) {
                    document.getElementById('properties-count').textContent = `${data.properties_count} propiedades registradas`;
                } else {
                    document.getElementById('properties-count').textContent = 'No tiene propiedades';
                }

                if (data.is_admin || data.is_member) {
                    document.getElementById('new-property-section').style.display = 'block';
                } else {
                    document.getElementById('new-property-section').style.display = 'none';
                }

            } catch (error) {
                console.error(error);
                localStorage.removeItem('api_token');
                window.location.href = '/login';
            }
        })();

        function logout() {
            window.apiToken = localStorage.getItem('api_token');
            fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        localStorage.removeItem('api_token');
                        window.location.href = '/login';
                    } else {
                        alert('Error cerrando sesión');
                    }
                });
        }
    </script>
</x-app-layout>