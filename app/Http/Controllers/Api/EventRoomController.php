<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateEventRoomDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEventRoom;
use App\Http\Resources\EventRoomResource;
use App\Services\EventRoomService;
use Illuminate\Http\Request;

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
    public function index()
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
