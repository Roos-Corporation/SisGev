<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateEventParticipantDTO;
use App\DTO\UpdateEventParticipantDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEventParticipant;
use App\Http\Resources\EventParticipantResource;
use App\Services\EventParticipantService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventParticipantController extends Controller
{
     /**
     * Create a new __construct to import the eventParticipantservice
     */
    public function __construct(
        protected EventParticipantService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Let's get all eventParticipants
        $eventParticipants = $this->service->getAll($request->filter);

        //Return the object
        return EventParticipantResource::collection($eventParticipants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateEventParticipant $request)
    {
        //Let's using the service to save the eventParticipantfrom the request validating first by the StoreUpdateEventParticipant
        $eventParticipant= $this->service->create(
            CreateEventParticipantDTO::makeFromRequest($request)
        );

        //Return the object
        return new EventParticipantResource($eventParticipant);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Let's check if exist and get the eventParticipantby the id
        if ( !$eventParticipant= $this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //If exist return the object found
        return new EventParticipantResource($eventParticipant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateEventParticipant $request, string $id)
    {
        //Let's using the service to update the eventParticipantfrom the request validating first by the StoreUpdateEventParticipant
        $request['id']= $id;
        $eventParticipant= $this->service->update(
            UpdateEventParticipantDTO::makeFromRequest($request,$id)
        );

        //Let's check if exist the eventParticipant
        if ( !$eventParticipant){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Return the object
        return new EventParticipantResource($eventParticipant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //Let's check if exist and get the eventParticipantby the id
         if ( !$this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Let's delete the eventParticipantby the id
        $this->service->delete($id);

        //Return the object found 204
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
