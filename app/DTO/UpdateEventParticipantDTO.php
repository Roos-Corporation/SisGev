<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEventParticipant;

class UpdateEventParticipantDTO
{
    public function __construct(
        public string $id,
        public int $event_id,
        public int $person_id,
        public string $ticket_number,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateEventParticipant $request, string $id): self
    {
        return new self(
            $request->id,
            $request->event_id,
            $request->person_id,
            $request->ticket_number,
            $request->status
        );
    }

}
