<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEvent;

class CreateEventDTO
{
    public function __construct(
        public string $name,
        public string $responsible,
        public string $stages,
        public int $capacity,
        public string $location,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateEvent $request): self
    {
        return new self(
            $request->name,
            $request->responsible,
            $request->stages,
            $request->capacity,
            $request->location,
            $request->status
        );
    }

}
