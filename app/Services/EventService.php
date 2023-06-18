<?php

namespace App\Services;

use App\DTO\{ CreateEventDTO, UpdateEventDTO };
use App\Repositories\EventRepositoryInterface;
use stdClass;

class EventService
{


    public function __construct(
        protected EventRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateEventDTO $dto): stdClass
    {
        return $this->repository-> create($dto);
    }

    public function update(UpdateEventDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
