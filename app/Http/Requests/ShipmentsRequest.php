<?php

namespace App\Http\Requests;

use App\Rules\ClientUserRole;
use Illuminate\Foundation\Http\FormRequest;

class ShipmentsRequest extends FormRequest
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
            'documents' => 'required|array',
            'document.*' => 'file|mimes:jpeg,jpg,png,webp,pdf,doc,docx|max:10240',
            'client_id' => ['required', new ClientUserRole()],
        ];
    }
}
