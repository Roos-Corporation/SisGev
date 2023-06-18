<?php

 namespace App\Repositories;

use App\DTO\{ CreateEventParticipantDTO, UpdateEventParticipantDTO };
use stdClass;

 interface EventParticipantRepositoryInterface
 {
    public function getAll(string $filter = null ): array;
    public function findOne(string $id): stdClass|null;
    public function create(CreateEventParticipantDTO $dto): stdClass;
    public function update(UpdateEventParticipantDTO $dto): stdClass|null;
    public function delete(string $id): void;
 }
