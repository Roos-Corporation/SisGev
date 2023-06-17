<?php

 namespace App\Repositories;

use App\DTO\{ CreatePersonDTO, UpdatePersonDTO };
use stdClass;

 interface PersonRepositoryInterface
 {
    public function getAll(string $filter = null ): array;
    public function findOne(string $id): stdClass|null;
    public function create(CreatePersonDTO $dto): stdClass;
    public function update(UpdatePersonDTO $dto): stdClass|null;
    public function delete(string $id): void;
 }
