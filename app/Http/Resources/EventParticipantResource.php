<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(!isset($this->id)){
            return [
                'id' => $this['eventParticipantId'],
                'event_id' => $this['event_id'],
                'event_name' => $this['name'],
                'event_responsible' => $this['responsible'],
                'event_stages' => $this['stages'],
                'event_capacity' => $this['capacity'],
                'event_location' => $this['location'],
                'person_id' => $this['person_id'],
                'person_cpf' => $this['cpf'],
                'person_first_name' => $this['first_name'],
                'person_last_name' => $this['last_name'],
                'person_accounting' => $this['accounting'],
                'person_date_of_birth' => $this['date_of_birth'],
                'person_gender' => $this['gender'],
                'ticket_number' => $this['ticket_number'],
                'status' => $this['eventParticipantStatus'],
                'date_created' => Carbon::make($this['created_at'])->format('Y-m-d H:i:s')
            ];
        }

        return [
            'id' => $this->eventParticipantId,
            'event_id' => $this->event_id,
            'event_name' => $this->name,
            'event_responsible' => $this->responsible,
            'event_stages' => $this->stages,
            'event_capacity' => $this->capacity,
            'event_location' => $this->location,
            'person_id' => $this->person_id,
            'person_cpf' => $this->cpf,
            'person_first_name' => $this->first_name,
            'person_last_name' => $this->last_name,
            'person_accounting' => $this->accounting,
            'person_date_of_birth' => $this->date_of_birth,
            'person_gender' => $this->gender,
            'person_id' => $this->person_id,
            'ticket_number' => $this->ticket_number,
            'status' => $this->eventParticipantStatus,
            'date_created' => Carbon::make($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
