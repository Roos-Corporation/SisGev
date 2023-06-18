<?php

namespace App\Services;

use App\DTO\{ CreateEventStageParticipantDTO, UpdateEventStageParticipantDTO };
use App\Repositories\EventStageParticipantRepositoryInterface;
use stdClass;

class EventStageParticipantService
{


    public function __construct(
        protected EventStageParticipantRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateEventStageParticipantDTO $dto): stdClass
    {
        return $this->repository-> create($dto);
    }

    public function update(UpdateEventStageParticipantDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
