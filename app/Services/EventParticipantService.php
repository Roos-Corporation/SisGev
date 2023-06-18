<?php

namespace App\Services;

use App\DTO\{ CreateEventParticipantDTO, UpdateEventParticipantDTO };
use App\Repositories\EventParticipantRepositoryInterface;
use stdClass;

class EventParticipantService
{


    public function __construct(
        protected EventParticipantRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateEventParticipantDTO $dto): stdClass
    {
        return $this->repository-> create($dto);
    }

    public function update(UpdateEventParticipantDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
