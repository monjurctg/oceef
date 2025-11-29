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
            $table->string('bncc_batch')->nullable()->after('nid');
            $table->string('religion')->nullable()->after('bncc_batch');
            $table->boolean('has_children_under_five')->nullable()->after('religion');
            $table->boolean('attend_wednesday_night')->nullable()->after('has_children_under_five');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('celebration_registrations', function (Blueprint $table) {
            $table->dropColumn(['bncc_batch', 'religion', 'has_children_under_five', 'attend_wednesday_night']);
        });
    }
};