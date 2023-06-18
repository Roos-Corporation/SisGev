<?php

namespace App\Repositories;

use App\DTO\CreateEventParticipantDTO;
use App\DTO\UpdateEventParticipantDTO;
use App\Models\EventParticipant;
use stdClass;

class EventParticipantEloquentORM implements EventParticipantRepositoryInterface{

    public function __construct(
        protected EventParticipant $model
    )
    {}

    public function getAll(string $filter = null ): array
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('ticket_number', 'like',  "%{$filter}%}");
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

    public function create(CreateEventParticipantDTO $dto): stdClass
    {
        $EventParticipant = (object) $this->model->create(
            (array) $dto
        );

        return (object) $EventParticipant->toArray();
    }

    public function update(UpdateEventParticipantDTO $dto): stdClass|null
    {
        if (!$EventParticipant = $this->model->find($dto->id)) {
            return null;
        }

        $EventParticipant->update(
            (array) $dto
        );

        return (object) $EventParticipant->toArray();
    }

    public function delete(string $id): void{
        $this->model->findOrFail($id)->delete();
    }
}
