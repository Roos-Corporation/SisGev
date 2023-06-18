<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_stage_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_participant_id')->constrained('event_participants');
            $table->foreignId('event_room_id')->constrained('event_rooms');
            $table->foreignId('coffee_space_id')->constrained('coffee_spaces');
            $table->enum('status', ['a', 'c']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_stage_participants');
    }
};
