<?php

namespace App\Policies;

use App\Constant\Role;
use App\Models\Offer;
use App\Models\User;

class OfferPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return  $user->role === 'user' || $user->role === 'admin';
    }
    public function update(User $user, Offer $offer)
    {
        return   $user->role === Role::ADMIN || ($user->role === Role::USER && $user->id === $offer->author_id);
    }
    public function MyView(User $user)
    {
        return   $user->role === Role::USER;
    }
}
