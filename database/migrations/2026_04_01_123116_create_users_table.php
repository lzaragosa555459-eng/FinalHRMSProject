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
       Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->unsignedInteger('employee_id')->nullable();
            $table->string('username', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->enum('system_role', ['hr','admin','employee'])->default('employee');
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
