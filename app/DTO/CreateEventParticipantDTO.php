<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEventParticipant;

class CreateEventParticipantDTO
{
    public function __construct(
        public int $event_id,
        public int $person_id,
        public string $ticket_number,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateEventParticipant $request): self
    {
        return new self(
            $request->event_id,
            $request->person_id,
            $request->ticket_number,
            $request->status
        );
    }

}
