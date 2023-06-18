<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEvent;

class UpdateEventDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $responsible,
        public string $stages,
        public int $capacity,
        public string $location,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateEvent $request, string $id): self
    {
        return new self(
            $request->id,
            $request->name,
            $request->responsible,
            $request->stages,
            $request->capacity,
            $request->location,
            $request->status
        );
    }

}
