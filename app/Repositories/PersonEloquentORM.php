<?php

namespace App\Repositories;

use App\DTO\CreatePersonDTO;
use App\DTO\UpdatePersonDTO;
use App\Models\Person;
use App\Repositories\PersonRepositoryInterface;
use stdClass;

class PersonEloquentORM implements PersonRepositoryInterface{

    public function __construct(
        protected Person $model
    )
    {}

    public function getAll(string $filter = null ): array
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('cpf', 'like',  "%{$filter}%}");
                            $query->orWhere('first_name', 'like',  "%{$filter}%}" );
                            $query->orWhere('last_name', 'like',  "%{$filter}%}" );
                            $query->orWhere('accounting', 'like',  "%{$filter}%}" );
                        }
                    })
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {

        $person = $this->model->find($id);

        if (!$person) {
            return null;
        }
       return  (object) $person->toArray();
    }

    public function create(CreatePersonDTO $dto): stdClass
    {
        $Person = (object) $this->model->create(
            (array) $dto
        );

        return (object) $Person->toArray();
    }

    public function update(UpdatePersonDTO $dto): stdClass|null
    {
        if (!$Person = $this->model->find($dto->id)) {
            return null;
        }

        $Person->update(
            (array) $dto
        );

        return (object) $Person->toArray();
    }

    public function delete(string $id): void{
        $this->model->findOrFail($id)->delete();
    }
}
