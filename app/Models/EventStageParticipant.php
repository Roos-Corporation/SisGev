<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStageParticipant extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_participant_id',
        'event_room_id',
        'coffee_space_id',
        'event_id',
        'people_id',
        'step',
        'status'
    ];
}
