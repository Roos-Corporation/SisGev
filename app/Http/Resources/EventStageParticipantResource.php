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
                'id' => $this['id'],
                'event_participant_id' => $this['event_participant_id'],
                'event_room_id' => $this['event_room_id'],
                'coffee_space_id' => $this['coffee_space_id'],
                'status' => $this['status'],
                'date_created' => Carbon::make($this['created_at'])->format('Y-m-d H:i:s')
            ];
        }
        return [
            'id' => $this->id,
            'event_participant_id' => $this->event_participant_id,
            'event_room_id' => $this->event_room_id,
            'coffee_space_id' => $this->coffee_space_id,
            'status' => $this->status,
            'date_created' => Carbon::make($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
