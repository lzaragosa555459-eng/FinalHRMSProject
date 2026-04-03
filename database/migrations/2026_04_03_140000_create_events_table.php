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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('title');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime')->nullable();

            // Location
            $table->string('location')->nullable(); // or "Online"

            // Department (single)
            $table->unsignedInteger('department_id')->nullable();

            // Description
            $table->text('description')->nullable();

            // Event Type
            $table->enum('event_type', [
                'meeting',
                'training',
                'team_building',
                'social',
                'workshop'
            ]);


            // Max Participants
            $table->integer('max_participants')->nullable();

            // Status
            $table->enum('status', [
                'draft',
                'published',
                'cancelled'
            ])->default('draft');

            $table->timestamps();

            // Foreign Keys
            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('set null');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
