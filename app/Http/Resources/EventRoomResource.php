<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventRoomResource extends JsonResource
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
                'name' => $this['name'],
                'capacity' => $this['capacity'],
                'location' => $this['location'],
                'status' => $this['status'],
                'date_created' => Carbon::make($this['created_at'])->format('Y-m-d H:i:s')
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'capacity' => $this->capacity,
            'location' => $this->location,
            'status' => $this->status,
            'date_created' => Carbon::make($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
