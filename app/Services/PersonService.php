<?php

namespace App\Services;

use App\DTO\{ CreatePeopleDTO, UpdatePeopleDTO };
use App\Repositories\PeopleRepositoryInterface;
use stdClass;

class PeopleService
{


    public function __construct(
        protected PeopleRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreatePeopleDTO $dto): stdClass
    {
        return $this->repository-> create($dto);
    }

    public function update(UpdatePeopleDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
