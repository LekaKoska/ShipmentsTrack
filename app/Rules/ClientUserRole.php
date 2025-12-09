<?php

namespace App\Rules;

use App\Enums\UserRole;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ClientUserRole implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isClient = User::where('id', $value)->where('role', UserRole::Client)->exists();

        if(!$isClient)
        {
            $fail('This user is not client!');
        }
    }
}
