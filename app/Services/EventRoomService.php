<?php

namespace App\Services;

use App\DTO\{ CreateEventRoomDTO, UpdateEventRoomDTO };
use App\Repositories\EventRoomRepositoryInterface;
use stdClass;

class EventRoomService
{


    public function __construct(
        protected EventRoomRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateEventRoomDTO $dto): stdClass
    {
        return $this->repository-> create($dto);
    }

    public function update(UpdateEventRoomDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
