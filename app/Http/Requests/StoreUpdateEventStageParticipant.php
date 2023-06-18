<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateEventStageParticipant extends FormRequest
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
            'event_participant_id' => [
                'required',
            ],
            'event_room_id' => [
                'required',
            ],
            'status' => [
                'required'
            ],

        ];
        if ( $this->method() === 'PUT' ||  $this->method() === 'PATCH') {
            $rules['event_participant_id'] = [
                'required',
                Rule::unique('event_stage_participants')->ignore($this->event_stage_participant)
            ];
        }

        return $rules;
    }
}
