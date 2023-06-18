<?php

 namespace App\Repositories;

use App\DTO\{ CreateEventRoomDTO, UpdateEventRoomDTO };
use stdClass;

 interface EventRoomRepositoryInterface
 {
    public function getAll(string $filter = null ): array;
    public function findOne(string $id): stdClass|null;
    public function create(CreateEventRoomDTO $dto): stdClass;
    public function update(UpdateEventRoomDTO $dto): stdClass|null;
    public function delete(string $id): void;
 }
