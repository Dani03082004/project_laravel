<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Inmobiliaria - Dani Bañeza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-600 to-blue-400 h-screen flex justify-center items-center">
    <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-md text-center">

        <div class="flex justify-center mb-2">
            <img src="{{ asset('img/logo1.png') }}" alt="logo" class="h-52 w-52 object-contain">
        </div>

        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">¡Bienvenido!</h2>
        <p class="text-lg text-gray-600 text-center mb-8">Sistema de gestión inmobiliaria desarrollado con Laravel, que permite a los usuarios gestionar sus propiedades de forma eficiente y segura.</p>

        <div class="flex justify-between">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-500 transition text-lg">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white py-3 px-6 rounded-md hover:bg-green-500 transition text-lg">Registrarse</a>
        </div>

    </div>

</body>

</html>