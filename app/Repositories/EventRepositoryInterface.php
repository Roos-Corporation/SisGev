<?php

 namespace App\Repositories;

use App\DTO\{ CreateEventDTO, UpdateEventDTO };
use stdClass;

 interface EventRepositoryInterface
 {
    public function getAll(string $filter = null ): array;
    public function findOne(string $id): stdClass|null;
    public function create(CreateEventDTO $dto): stdClass;
    public function update(UpdateEventDTO $dto): stdClass|null;
    public function delete(string $id): void;
 }
