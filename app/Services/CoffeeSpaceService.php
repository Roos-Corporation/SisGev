<?php

namespace App\Services;

use App\DTO\{ CreateCoffeeSpaceDTO, UpdateCoffeeSpaceDTO };
use App\Repositories\CoffeeSpaceRepositoryInterface;
use stdClass;

class CoffeeSpaceService
{


    public function __construct(
        protected CoffeeSpaceRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateCoffeeSpaceDTO $dto): stdClass
    {
        return $this->repository-> create($dto);
    }

    public function update(UpdateCoffeeSpaceDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
