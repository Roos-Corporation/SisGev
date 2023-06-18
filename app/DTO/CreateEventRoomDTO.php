<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEventRoom;

class CreateEventRoomDTO
{
    public function __construct(
        public string $name,
        public string $capacity,
        public string $location,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateEventRoom $request): self
    {
        return new self(
            $request->name,
            $request->capacity,
            $request->location,
            $request->status
        );
    }

}
