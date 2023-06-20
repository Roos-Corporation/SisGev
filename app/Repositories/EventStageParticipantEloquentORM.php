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
        // dd(explode(":",$filter));
        return $this->model
                    ->select('*', $this->model::raw('event_stage_participants.id as eventStageParticipantId'), $this->model::raw('event_stage_participants.status as eventStageParticipantStatus'), $this->model::raw('events.name as eventName'), $this->model::raw('coffee_spaces.name as coffeeSpaceName'), $this->model::raw('event_participants.status as eventParticipantStatus'), $this->model::raw('event_rooms.name as eventRoomName'))
                    ->leftJoin('coffee_spaces', 'coffee_spaces.id', '=', 'event_stage_participants.coffee_space_id')
                    ->leftJoin('event_rooms', 'event_rooms.id', '=', 'event_stage_participants.event_room_id')
                    ->leftJoin('event_participants', 'event_participants.id', '=', 'event_stage_participants.event_participant_id')
                    ->leftJoin('events', 'events.id', '=', 'event_participants.event_id')
                    ->leftJoin('people', 'people.id', '=', 'event_participants.person_id')
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $filter = explode(":",$filter);
                            $query->where($filter[0], '=',  $filter[1]);
                        }
                    })
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {

        $eventStageParticipant = $this->model
        ->select('*', $this->model::raw('event_stage_participants.id as eventStageParticipantId'), $this->model::raw('event_stage_participants.status as eventStageParticipantStatus'), $this->model::raw('events.name as eventName'), $this->model::raw('coffee_spaces.name as coffeeSpaceName'), $this->model::raw('event_participants.status as eventParticipantStatus'), $this->model::raw('event_rooms.name as eventRoomName'))
        ->leftJoin('coffee_spaces', 'coffee_spaces.id', '=', 'event_stage_participants.coffee_space_id')
        ->leftJoin('event_rooms', 'event_rooms.id', '=', 'event_stage_participants.event_room_id')
        ->leftJoin('event_participants', 'event_participants.id', '=', 'event_stage_participants.event_participant_id')
        ->leftJoin('events', 'events.id', '=', 'event_participants.event_id')
        ->leftJoin('people', 'people.id', '=', 'event_participants.person_id')
        ->where('event_participant_id', '=', $id)->get()
        ->toArray();
        // find($id)
        if (!$eventStageParticipant) {
            return null;
        }
       return  (object) $eventStageParticipant;
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
        // dd($id);
        $this->model->where('event_participant_id', '=', $id)->delete();
        // findOrFail($id)->delete();
    }
}
