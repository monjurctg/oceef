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
        Schema::create('celebration_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_num');
            $table->string('email');
            $table->text('address');
            $table->string('emergency_contact');
            $table->integer('family_members');
            $table->integer('children_count')->default(0);
            $table->boolean('has_driver')->default(false);
            $table->string('nid')->nullable();
            $table->string('payment_method'); // Bank, Bkash, Nagad, Rocket
            $table->string('transaction_number');
            $table->string('transaction_screenshot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celebration_registrations');
    }
};