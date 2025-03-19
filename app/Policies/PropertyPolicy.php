<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy{
    public function view(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->role->name === 'admin';
    }

    public function create(User $user)
    {
        return $user->role->name === 'member' || $user->role->name === 'admin';
    }

    public function update(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->role->name === 'admin';
    }

    public function delete(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->role->name === 'admin';
    }
}
