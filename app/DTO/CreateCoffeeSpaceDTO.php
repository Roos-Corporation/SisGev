<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateCoffeeSpace;

class CreateCoffeeSpaceDTO
{
    public function __construct(
        public string $name,
        public int $capacity,
        public string $location,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdateCoffeeSpace $request): self
    {
        return new self(
            $request->name,
            $request->capacity,
            $request->location,
            $request->status
        );
    }

}
