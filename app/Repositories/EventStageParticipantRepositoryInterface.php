<?php

 namespace App\Repositories;

use App\DTO\{ CreateEventStageParticipantDTO, UpdateEventStageParticipantDTO };
use stdClass;

 interface EventStageParticipantRepositoryInterface
 {
    public function getAll(string $filter = null ): array;
    public function findOne(string $id): stdClass|null;
    public function create(CreateEventStageParticipantDTO $dto): stdClass;
    public function update(UpdateEventStageParticipantDTO $dto): stdClass|null;
    public function delete(string $id): void;
 }
