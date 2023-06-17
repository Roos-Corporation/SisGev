<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreatePersonDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePerson;
use App\Http\Resources\PersonResource;
use App\Services\PersonService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PersonController extends Controller
{

    /**
     * Create a new __construct to import the personService
     */
    public function __construct(
        protected PersonService $service
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
    public function store(StoreUpdatePerson $request)
    {
        //Let's using the service to save the person from the request validating first by the StoreUpdatePerson
        $person = $this->service->create(
            CreatePersonDTO::makeFromRequest($request)
        );

        //Return the object
        return new PersonResource($person);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Let's check if exist and get the person by the id
        if ( !$person = $this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //If exist return the object found
        return new PersonResource($person);
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
        //Let's check if exist and get the person by the id
        if ( !$this->service->findOne($id) ){
            return response()->json([
                'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        //Let's delete the person by the id
        $this->service->delete($id);

        //Return the object found 204
        return response()->json([], Response::HTTP_NO_CONTENT);

    }
}
