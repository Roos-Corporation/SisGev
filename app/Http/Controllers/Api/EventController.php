<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateEventDTO;
use App\DTO\UpdateEventDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEvent;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
     /**
     * Create a new __construct to import the eventervice
     */
    public function __construct(
        protected EventService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Let's get all events
        $events = $this->service->getAll($request->filter);

        //Return the object
        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateEvent $request)
    {
        //Let's using the service to save the eventfrom the request validating first by the StoreUpdateEvent
        $event= $this->service->create(
            CreateEventDTO::makeFromRequest($request)
        );

        //Return the object
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Let's check if exist and get the eventby the id
        if ( !$event= $this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //If exist return the object found
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateEvent $request, string $id)
    {
        //Let's using the service to update the eventfrom the request validating first by the StoreUpdateEvent
        $request['id']= $id;
        $event= $this->service->update(
            UpdateEventDTO::makeFromRequest($request,$id)
        );

        //Let's check if exist the event
        if ( !$event){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Return the object
        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //Let's check if exist and get the eventby the id
         if ( !$this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Let's delete the eventby the id
        $this->service->delete($id);

        //Return the object found 204
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
