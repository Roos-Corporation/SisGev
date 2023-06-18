<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateCoffeeSpace extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'unique:coffee_spaces'
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
                Rule::unique('coffee_spaces')->ignore($this->coffee_space)
            ];
        }

        return $rules;
    }
}
