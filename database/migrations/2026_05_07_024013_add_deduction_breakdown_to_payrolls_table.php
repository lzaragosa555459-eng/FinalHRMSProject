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
        Schema::table('payrolls', function (Blueprint $table) {
            $table->decimal('tax', 10, 2)->nullable()->after('deduction');
            $table->decimal('sss', 10, 2)->nullable()->after('tax');
            $table->decimal('philhealth', 10, 2)->nullable()->after('sss');
            $table->decimal('pagibig', 10, 2)->nullable()->after('philhealth');
        });
    }

    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropColumn(['tax', 'sss', 'philhealth', 'pagibig']);
        });
    }
};
