<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Property $property)
    {
        return $user->hasRole('admin') || $user->id === $property->user_id;
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['admin', 'member']);
    }

    public function update(User $user, Property $property)
    {
        return $user->hasRole('admin') || $user->id === $property->user_id;
    }

    public function delete(User $user, Property $property)
    {
        return $user->hasRole('admin') || $user->id === $property->user_id;
    }
}
