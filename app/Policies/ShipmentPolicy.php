<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Shipment;
use App\Models\User;
use App\Traits\IsAdmin;
use Illuminate\Auth\Access\Response;

class ShipmentPolicy
{
    use IsAdmin;
    public function create(User $user): Response
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, Shipment $shipment)
    {
        return $user->role === UserRole::Administrator || $shipment->client_id === $user->id;
    }

    public function edit(User $user): Response
    {
        return $this->isAdmin($user);
    }

}
