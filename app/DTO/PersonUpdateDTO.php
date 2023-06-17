<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdatePerson;

class UpdatePersonDTO
{
    public function __construct(
        public string $id,
        public string $cpf,
        public string $first_name,
        public string $last_name,
        public string $accounting,
        public string $date_of_birth,
        public string $gender,
        public string $status
    )
    {}

    public static function makeFromRequest(StoreUpdatePerson $request): self
    {
        return new self(
            $request->id,
            $request->cpf,
            $request->first_name,
            $request->last_name,
            $request->accounting,
            $request->date_of_birth,
            $request->gender,
            $request->status == 'on'? 'a' : 'i'
        );
    }

}
