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
            'fromCity' => 'required',
            'fromCountry' => 'required',
            'toCity' => 'required',
            'toCountry' => 'required',
            'price' => 'required',
            'status' => 'required|in:in_progress,unassigned,completed,problem',
            'details' => 'required',
            'documents' => 'required|array',
            'document.*' => 'file|mimes:jpeg,jpg,png,webp,pdf,doc,docx|max:10240',
            'clientId' => ['required', new ClientUserRole()],
        ];
    }
}
