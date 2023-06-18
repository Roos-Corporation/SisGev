<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateCoffeeSpace;

class UpdateCoffeeSpaceDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public int $capacity,
        public string $location,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateCoffeeSpace $request, string $id): self
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
