<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@piopio.com')->first();
        $member = User::where('email', 'member1@piopio.com')->first();

        if ($admin && $member) {
            Property::factory(5)->create(['user_id' => $admin->id]);
            Property::factory(10)->create(['user_id' => $member->id]);
        }
    }
}
