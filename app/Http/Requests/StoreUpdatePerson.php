<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePeople extends FormRequest
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
            'cpf' => [
                'required',
                'min:11',
                'max:14',
                'unique:people'
            ],
            'first_name' => [
                'required',
                'min:3',
                'max:255'
            ],
            'last_name' => [
                'required',
                'min:3',
                'max:255'
            ],
            'accounting' => [
                'required',
                'min:3',
                'max:255'
            ],
            'date_of_birth' => [
                'required',
                'date',
                'max:255'
            ],
            'gender' => [
                'required'
            ],

        ];

        if ( $this->method() === 'PUT') {

            $rules['cpf'] = [
                'required',
                'min:11',
                'max:14',
                Rule::unique('people')->ignore($this->id)
            ];
        }

        return $rules;
    }
}
