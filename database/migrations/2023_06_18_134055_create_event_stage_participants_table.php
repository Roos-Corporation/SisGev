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

            $table->unsignedBigInteger('event_participant_id')->nullable();
            $table->foreign('event_participant_id')->references('id')->on('event_participants')->nullable()->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger('event_room_id')->nullable();
            $table->foreign('event_room_id')->references('id')->on('event_rooms')->nullable()->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger('coffee_space_id')->nullable();
            $table->foreign('coffee_space_id')->references('id')->on('coffee_spaces')->nullable()->constrained()->cascadeOnDelete();


            $table->integer('event_id');
            $table->integer('people_id');
            $table->integer('step');

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
