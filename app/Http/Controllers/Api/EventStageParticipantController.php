<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateEventStageParticipantDTO;
use App\DTO\UpdateEventStageParticipantDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEventStageParticipant;
use App\Http\Resources\EventStageParticipantResource;
use App\Services\EventStageParticipantService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventStageParticipantController extends Controller
{
    /**
     * Create a new __construct to import the eventStageParticipantservice
     */
    public function __construct(
        protected EventStageParticipantService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Let's get all eventStageParticipants
        $eventStageParticipants = $this->service->getAll($request->filter);

        //Return the object
        return EventStageParticipantResource::collection($eventStageParticipants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateEventStageParticipant $request)
    {
        //Let's using the service to save the eventStageParticipantfrom the request validating first by the StoreUpdateEventStageParticipant
        $eventStageParticipant= $this->service->create(
            CreateEventStageParticipantDTO::makeFromRequest($request)
        );

        $eventStageParticipant= $this->service->findOne($eventStageParticipant->id);

        //Return the object
        return new EventStageParticipantResource($eventStageParticipant);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Let's check if exist and get the eventStageParticipantby the id
        if ( !$eventStageParticipant= $this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //If exist return the object found
        return new EventStageParticipantResource($eventStageParticipant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateEventStageParticipant $request, string $id)
    {
        //Let's using the service to update the eventStageParticipantfrom the request validating first by the StoreUpdateEventStageParticipant
        $request['id']= $id;
        $eventStageParticipant= $this->service->update(
            UpdateEventStageParticipantDTO::makeFromRequest($request,$id)
        );

        $eventStageParticipant= $this->service->findOne($id);
        //Let's check if exist the eventStageParticipant
        if ( !$eventStageParticipant){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Return the object
        return new EventStageParticipantResource($eventStageParticipant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //Let's check if exist and get the eventStageParticipantby the id
         if ( !$this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Let's delete the eventStageParticipantby the id
        $this->service->delete($id);

        //Return the object found 204
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
