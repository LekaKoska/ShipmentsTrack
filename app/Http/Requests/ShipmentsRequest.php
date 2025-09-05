<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
            'user_id' => 'required|exists:users,id',
            'details' => 'required'
        ];
    }
}
