<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEventRoom;

class UpdateEventRoomDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public int $capacity,
        public string $location,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateEventRoom $request, string $id): self
    {
        return new self(
            $request->id,
            $request->name,
            $request->capacity,
            $request->location,
            $request->status
        );
    }

}
