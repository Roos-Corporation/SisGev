<?php

namespace App\Repositories;

use App\DTO\CreateEventRoomDTO;
use App\DTO\UpdateEventRoomDTO;
use App\Models\EventRoom;
use App\Repositories\EventRoomRepositoryInterface;
use stdClass;

class EventRoomEloquentORM implements EventRoomRepositoryInterface{

    public function __construct(
        protected EventRoom $model
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

        $person = $this->model->find($id);

        if (!$person) {
            return null;
        }
       return  (object) $person->toArray();
    }

    public function create(CreateEventRoomDTO $dto): stdClass
    {
        $EventRoom = (object) $this->model->create(
            (array) $dto
        );

        return (object) $EventRoom->toArray();
    }

    public function update(UpdateEventRoomDTO $dto): stdClass|null
    {
        if (!$EventRoom = $this->model->find($dto->id)) {
            return null;
        }

        $EventRoom->update(
            (array) $dto
        );

        return (object) $EventRoom->toArray();
    }

    public function delete(string $id): void{
        $this->model->findOrFail($id)->delete();
    }
}
