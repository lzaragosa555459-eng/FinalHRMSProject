<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**hi
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->increments('employee_id');

            $table->string('employee_number', 50)->unique();
            $table->string('name', 150);
            $table->string('phone_number', 20);
            $table->text('address');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);

            $table->string('profile_image')->nullable();

            $table->enum('employee_role', ['head', 'employee'])->default('employee');

            // POSITION
            $table->unsignedInteger('position_id')->nullable();
            $table->foreign('position_id')
                ->references('position_id')
                ->on('positions')
                ->onDelete('set null');

            // APPLICANT
            $table->unsignedInteger('applicant_id')->nullable();
            $table->foreign('applicant_id')
                ->references('applicant_id')
                ->on('applicants')
                ->onDelete('set null');

            // MANAGER (FIXED)
            $table->unsignedInteger('manager_id')->nullable();
            $table->foreign('manager_id')
                ->references('employee_id')
                ->on('employees')
                ->onDelete('set null');

            $table->date('hire_date')->nullable();

            $table->enum('status', ['active', 'resigned', 'inactive'])
                ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
