<?php

namespace App\Services;

use App\DTO\{ CreatePersonDTO, UpdatePersonDTO };
use App\Repositories\PersonRepositoryInterface;
use stdClass;

class PersonService
{


    public function __construct(
        protected PersonRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreatePersonDTO $dto): stdClass
    {
        return $this->repository-> create($dto);
    }

    public function update(UpdatePersonDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
