<?php

namespace App\Repositories;

use App\DTO\CreateCoffeeSpaceDTO;
use App\DTO\UpdateCoffeeSpaceDTO;
use App\Models\CoffeeSpace;
use stdClass;

class CoffeeSpaceEloquentORM implements CoffeeSpaceRepositoryInterface{

    public function __construct(
        protected CoffeeSpace $model
    )
    {}

    public function getAll(string $filter = null ): array
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('name', 'like',  "%{$filter}%}");
                            $query->orWhere('location', 'like',  "%{$filter}%}" );
                        }
                    })
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {

        $coffeeSpace = $this->model->find($id);

        if (!$coffeeSpace) {
            return null;
        }
       return  (object) $coffeeSpace->toArray();
    }

    public function create(CreateCoffeeSpaceDTO $dto): stdClass
    {
        $CoffeeSpace = (object) $this->model->create(
            (array) $dto
        );

        return (object) $CoffeeSpace->toArray();
    }

    public function update(UpdateCoffeeSpaceDTO $dto): stdClass|null
    {
        if (!$CoffeeSpace = $this->model->find($dto->id)) {
            return null;
        }

        $CoffeeSpace->update(
            (array) $dto
        );

        return (object) $CoffeeSpace->toArray();
    }

    public function delete(string $id): void{
        $this->model->findOrFail($id)->delete();
    }
}
