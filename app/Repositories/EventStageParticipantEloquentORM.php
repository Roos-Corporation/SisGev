<?php

namespace App\Repositories;

use App\DTO\CreateEventStageParticipantDTO;
use App\DTO\UpdateEventStageParticipantDTO;
use App\Models\EventStageParticipant;
use stdClass;

class EventStageParticipantEloquentORM implements EventStageParticipantRepositoryInterface{

    public function __construct(
        protected EventStageParticipant $model
    )
    {}

    public function getAll(string $filter = null ): array
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('event_participant_id', 'like',  "%{$filter}%}");
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

    public function create(CreateEventStageParticipantDTO $dto): stdClass
    {
        $EventStageParticipant = (object) $this->model->create(
            (array) $dto
        );

        return (object) $EventStageParticipant->toArray();
    }

    public function update(UpdateEventStageParticipantDTO $dto): stdClass|null
    {
        if (!$EventStageParticipant = $this->model->find($dto->id)) {
            return null;
        }

        $EventStageParticipant->update(
            (array) $dto
        );

        return (object) $EventStageParticipant->toArray();
    }

    public function delete(string $id): void{
        $this->model->findOrFail($id)->delete();
    }
}
