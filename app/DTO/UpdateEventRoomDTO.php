<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdatePerson;

class UpdatePersonDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $capacity,
        public string $location,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdatePerson $request, string $id): self
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
