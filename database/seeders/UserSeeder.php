<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $role_member = Role::where('name', 'member')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'Member1';
        $user->email = 'member1@piopio.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_member);
        
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@piopio.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
