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
        Schema::create('employees', function (Blueprint $table) 
        {
            $table->increments('employee_id');
            $table->string('employee_number', 50)->unique()->nullable();
            $table->string('name', 150)->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('role', ['head', 'employee'])->default('employee');
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('applicant_id')->nullable();
            $table->date('hire_date')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->unsignedInteger('manager_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->enum('status', ['active','resigned','inactive']);
            $table->timestamps();

            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('set null');
            $table->foreign('position_id')->references('position_id')->on('positions')->onDelete('set null');
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants')->onDelete('set null');
            $table->foreign('manager_id')->references('employee_id')->on('employees')->onDelete('set null');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
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
