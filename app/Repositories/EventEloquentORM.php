<?php

namespace App\Repositories;

use App\DTO\CreateEventDTO;
use App\DTO\UpdateEventDTO;
use App\Models\Event;
use stdClass;

class EventEloquentORM implements EventRepositoryInterface{

    public function __construct(
        protected Event $model
    )
    {}

    public function getAll(string $filter = null ): array
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('name', 'like',  "%{$filter}%}");
                            $query->orWhere('responsible', 'like',  "%{$filter}%}" );
                            $query->orWhere('location', 'like',  "%{$filter}%}" );
                        }
                    })
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {

        $event = $this->model->find($id);

        if (!$event) {
            return null;
        }
       return  (object) $event->toArray();
    }

    public function create(CreateEventDTO $dto): stdClass
    {
        $Event = (object) $this->model->create(
            (array) $dto
        );

        return (object) $Event->toArray();
    }

    public function update(UpdateEventDTO $dto): stdClass|null
    {
        if (!$Event = $this->model->find($dto->id)) {
            return null;
        }

        $Event->update(
            (array) $dto
        );

        return (object) $Event->toArray();
    }

    public function delete(string $id): void{
        $this->model->findOrFail($id)->delete();
    }
}
