<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlastRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'delay' => [
                'required',
                'integer'
            ],
            'phonebook_id' => [
                'required',
                'exists:phonebooks,id'
            ],
            'message' => [
                'required',
                'string',
                'max:255'
            ],
            'scheduled_at' => [
                'nullable',
            ]
        ];
    }
}
