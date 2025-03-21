<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Property;

class PropertyPolicy{

    public function view(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->roles()->where('name', 'admin')->exists();
    }

    public function create(User $user)
    {
        return $user->roles()->whereIn('name', ['member', 'admin'])->exists();
    }

    public function update(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->roles()->where('name', 'admin')->exists();
    }

    public function delete(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->roles()->where('name', 'admin')->exists();
    }
}
