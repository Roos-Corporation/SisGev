<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateEventParticipant extends FormRequest
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
            'event_id' => [
                'required',
            ],
            'person_id' => [
                'required',
            ],
            'status' => [
                'required'
            ],

        ];
        if ( $this->method() === 'PUT' ||  $this->method() === 'PATCH') {
            $rules['person_id'] = [
                'required',
                Rule::unique('event_participants')->ignore($this->event_participant)
            ];
        }

        return $rules;
    }
}
