<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreatePersonDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePerson;
use App\Http\Resources\PersonResource;
use App\Services\PersonService;
use Illuminate\Http\Request;

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
        //Let using the service to save the person from the request validating first by the StoreUpdatePerson
        $person = $this->service->create(
            CreatePersonDTO::makeFromRequest($request)
        );

        return new PersonResource($person);
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
