<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Rules\ClientUserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShipment extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'from_city' => 'required',
            'from_country' => 'required',
            'to_city' => 'required',
            'to_country' => 'required',
            'price' => 'required',
            'status' => 'required|in:in_progress,unassigned,completed,problem',
            'details' => 'required',
            'user_id' => [
                'required',
                Rule::exists(table: 'users', column: 'id')->where(function ($query)
                {
                    $query->where('role', UserRole::Trucker);
                })],
            'client_id' => ['required', new ClientUserRole()]
        ];
    }
}
