<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateCoffeeSpaceDTO;
use App\DTO\UpdateCoffeeSpaceDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCoffeeSpace;
use App\Http\Resources\CoffeeSpaceResource;
use App\Services\CoffeeSpaceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CoffeeSpaceController extends Controller
{
    /**
     * Create a new __construct to import the CoffeeSpaceService
     */
    public function __construct(
        protected CoffeeSpaceService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Let's get all coffeeSpaces
        $coffeeSpaces = $this->service->getAll($request->filter);

        //Return the object
        return CoffeeSpaceResource::collection($coffeeSpaces);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCoffeeSpace $request)
    {
        //Let's using the service to save the eventRoom from the request validating first by the StoreUpdateCoffeeSpace
        $eventRoom = $this->service->create(
            CreateCoffeeSpaceDTO::makeFromRequest($request)
        );

        //Return the object
        return new CoffeeSpaceResource($eventRoom);
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
        return new CoffeeSpaceResource($eventRoom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCoffeeSpace $request, string $id)
    {
        //Let's using the service to update the eventRoom from the request validating first by the StoreUpdateCoffeeSpace
        $request['id']= $id;
        $eventRoom = $this->service->update(
            UpdateCoffeeSpaceDTO::makeFromRequest($request,$id)
        );

        //Let's check if exist the eventRoom
        if ( !$eventRoom ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Return the object
        return new CoffeeSpaceResource($eventRoom);
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
