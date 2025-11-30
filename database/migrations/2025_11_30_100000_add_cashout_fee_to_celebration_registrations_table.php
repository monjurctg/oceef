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
        Schema::table('celebration_registrations', function (Blueprint $table) {
            $table->decimal('cashout_fee', 8, 2)->default(0)->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('celebration_registrations', function (Blueprint $table) {
            $table->dropColumn('cashout_fee');
        });
    }
};