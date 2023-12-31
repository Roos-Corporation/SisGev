<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(!isset($this->id)){
            return [
                'id' => $this['id'],
                'cpf' => $this['cpf'],
                'firstName' => $this['first_name'],
                'lastName' => $this['last_name'],
                'accounting' => $this['accounting'],
                'dateOfBirth' => $this['date_of_birth'],
                'gender' => $this['gender'],
                'status' => $this['status'],
                'date_created' => Carbon::make($this['created_at'])->format('Y-m-d H:i:s')
            ];
        }
        return [
            'id' => $this->id,
            'cpf' => $this->cpf,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'accounting' => $this->accounting,
            'dateOfBirth' => $this->date_of_birth,
            'gender' => $this->gender,
            'status' => $this->status,
            'date_created' => Carbon::make($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
