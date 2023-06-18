<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEventStageParticipant;

class UpdateEventStageParticipantDTO
{
    public function __construct(
        public string $id,
        public int $event_participant_id,
        public int $event_room_id,
        public int $coffee_space_id,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateEventStageParticipant $request, string $id): self
    {
        return new self(
            $request->id,
            $request->event_participant_id,
            $request->event_room_id,
            $request->coffee_space_id,
            $request->status
        );
    }

}
