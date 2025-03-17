<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 50000, 500000),
            'status' => $this->faker->randomElement(['sale', 'rent']),
            'location' => $this->faker->city(),
            'size' => $this->faker->numberBetween(50, 500),
        ];
    }
}
