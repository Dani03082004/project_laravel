<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ShowPropertiesFromApi extends Command
{
    protected $signature = 'app:show-properties';

    protected $description = 'Muestra las propiedades desde la API autenticándose con token';

    public function handle()
    {
        $email = $this->ask('Email?');
        $password = $this->secret('Password?');

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        $response = Http::post(env('API_URL') . '/api/login', $credentials);

        if ($response->successful()) {
            $token = $response->json()['data']['token'];

            $propertiesResponse = Http::withToken($token)
                ->get(env('API_URL') . '/api/properties/index');

            if ($propertiesResponse->successful()) {
                $properties = $propertiesResponse->json()['data'] ?? [];

                if (empty($properties)) {
                    $this->info('No hay propiedades disponibles.');
                    return 0;
                }

                foreach ($properties as $property) {
                    $this->line("Propiedad [{$property['id']}]: {$property['title']} - {$property['location']}");
                }
            } else {
                $this->error('Error al obtener propiedades. Status: ' . $propertiesResponse->status());
            }
        } else {
            $this->error('Error en autenticación. Verifica email y contraseña.');
        }
    }
}
