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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('payroll_id');
            $table->unsignedInteger('employee_id')->nullable();
            $table->decimal('basic_salary', 10, 2)->nullable();
            $table->decimal('allowances', 10, 2)->nullable();
            $table->decimal('deduction', 10, 2)->nullable();
            $table->decimal('net_salary', 10, 2)->nullable();
            $table->date('pay_date')->nullable();

            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
