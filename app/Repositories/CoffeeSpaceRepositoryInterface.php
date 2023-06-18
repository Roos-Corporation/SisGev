<?php

 namespace App\Repositories;

use App\DTO\{ CreateCoffeeSpaceDTO, UpdateCoffeeSpaceDTO };
use stdClass;

 interface CoffeeSpaceRepositoryInterface
 {
    public function getAll(string $filter = null ): array;
    public function findOne(string $id): stdClass|null;
    public function create(CreateCoffeeSpaceDTO $dto): stdClass;
    public function update(UpdateCoffeeSpaceDTO $dto): stdClass|null;
    public function delete(string $id): void;
 }
