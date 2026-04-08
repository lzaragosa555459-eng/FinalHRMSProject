<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id('performance_id');

            $table->unsignedInteger('employee_id');
            $table->string('review_period')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->text('comments')->nullable();

            $table->unsignedInteger('reviewer_id')->nullable();
            $table->date('review_date')->nullable();

            $table->enum('status', ['Pending', 'Completed', 'Reviewed'])->default('Pending');

            $table->timestamps();

            // Foreign keys
            $table->foreign('employee_id')
                  ->references('employee_id')
                  ->on('employees')
                  ->onDelete('cascade');

            $table->foreign('reviewer_id')
                  ->references('employee_id')
                  ->on('employees')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance');
    }
};