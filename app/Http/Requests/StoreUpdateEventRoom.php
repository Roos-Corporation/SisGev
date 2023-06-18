<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateEventRoom extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            //
            'name' => [
                'required',
                'min:3',
                'max:255',
                'unique:event_rooms'
            ],
            'capacity' => [
                'required',
                'min:1'
            ],
            'status' => [
                'required'
            ],

        ];
        if ( $this->method() === 'PUT' ||  $this->method() === 'PATCH') {
            $rules['name'] = [
                'required',
                'min:3',
                'max:255',
                Rule::unique('event_rooms')->ignore($this->event_room)
            ];
        }

        return $rules;
    }
}
