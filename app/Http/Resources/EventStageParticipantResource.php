<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventStageParticipantResource extends JsonResource
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
                'id' => $this['eventStageParticipantId'],
                'event_participant_id' => $this['event_participant_id'],
                'event_room_id' => $this['event_room_id'],
                'event_name' => $this['eventName'],
                'person_first_name' => $this['first_name'],
                'person_last_name' => $this['last_name'],
                'coffee_space_id' => $this['coffee_space_id'],
                'coffee_space_name' => $this['coffeeSpaceName'],
                'event_participant_status' => $this['eventStageParticipantStatus'],
                'status' => $this['eventParticipantStatus'],
                'date_created' => Carbon::make($this['created_at'])->format('Y-m-d H:i:s')
            ];
        }


        return [
            'id' => $this->eventStageParticipantId,
            'event_participant_id' => $this->event_participant_id,
            'event_room_id' => $this->event_room_id,
            'event_name' => $this->eventName,
            'person_first_name' => $this->first_name,
            'person_last_name' => $this->last_name,
            'coffee_space_id' => $this->coffee_space_id,
            'coffee_space_name' => $this->coffeeSpaceName,
            'event_participant_status' => $this->eventStageParticipantStatus,
            'status' => $this->eventStageParticipantStatus,
            'date_created' => Carbon::make($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
