<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateEventRoomDTO;
use App\DTO\UpdateEventRoomDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEventRoom;
use App\Http\Resources\EventRoomResource;
use App\Models\EventRoom;
use App\Services\EventRoomService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventRoomController extends Controller
{
    /**
     * Create a new __construct to import the eventRoomService
     */
    public function __construct(
        protected EventRoomService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Let's get all eventRooms
        $eventRooms = $this->service->getAll($request->filter);

        //Return the object
        return EventRoomResource::collection($eventRooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateEventRoom $request)
    {
        //Let's using the service to save the eventRoom from the request validating first by the StoreUpdateEventRoom
        $eventRoom = $this->service->create(
            CreateEventRoomDTO::makeFromRequest($request)
        );

        //Return the object
        return new EventRoomResource($eventRoom);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Let's check if exist and get the eventRoom by the id
        if ( !$eventRoom = $this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //If exist return the object found
        return new EventRoomResource($eventRoom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateEventRoom $request, string $id)
    {
        //Let's using the service to update the eventRoom from the request validating first by the StoreUpdateEventRoom
        $request['id']= $id;
        $eventRoom = $this->service->update(
            UpdateEventRoomDTO::makeFromRequest($request,$id)
        );

        //Let's check if exist the eventRoom
        if ( !$eventRoom ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Return the object
        return new EventRoomResource($eventRoom);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //Let's check if exist and get the eventRoom by the id
         if ( !$this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Let's delete the eventRoom by the id
        $this->service->delete($id);

        //Return the object found 204
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
